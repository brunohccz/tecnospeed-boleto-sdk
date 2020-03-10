<?php

namespace Tecnospeed;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\RequestInterface;
use Tecnospeed\Core\Boleto\Cedente;
use Tecnospeed\Core\Boleto\Conta;
use Tecnospeed\Core\Boleto\Convenio;
use Tecnospeed\Core\Boleto\Lote;
use Tecnospeed\Core\Boleto\PDF;
use Tecnospeed\Core\Traits\TecnospeedRequest;

class Boleto
{
  use TecnospeedRequest;

  /**
   * @var Cedente
   */
  private $cedente;

  /**
   * @var Conta
   */
  private $conta;

  /**
   * @var Convenio
   */
  private $convenio;

  /**
   * @var Lote
   */
  private $lote;

  /**
   * @var PDF;
   */
  private $pdf;

  /**
   * @var GuzzleHttp\Client;
   */
  private $client;

  /**
   * @var string
   */
  protected $baseUrl;

  public const ENV_HOMOGACAO = 0;

  public const ENV_PRODUCAO = 1;

  public function __construct(array $config = [])
  {
    $this->setEnvironment($config);

    $this->client = new Client([
      'base_url' => $this->baseUrl,
      'defaults' => [
        'headers' => [
          'content-type' => 'application/json',
          'cnpj-cedente' => $config['cnpj-cedente'] ?? '',
          'cnpj-sh'      => $config['cnpj-sh'],
          'token-sh'     => $config['hash-sh']
        ]
      ]
    ]);

    $this->cedente = new Cedente($this);
    $this->conta = new Conta($this);
    $this->convenio = new Convenio($this);
    $this->lote = new Lote($this);
    $this->pdf = new PDF($this);
  }

  protected function setEnvironment($config)
  {
    $urlHomologacao = 'http://homologacao.plugboleto.com.br/api/v1/';
    $urlProducao = 'http://plugboleto.com.br/api/v1/';

    $this->baseUrl = $config['env'] === self::ENV_HOMOGACAO ?
      $urlHomologacao : $urlProducao;
  }

  public function request($uri, $data = [], $method = 'post', array $headers = [])
  {
    try {
      $request = $this->{'create'.ucfirst($method).'Request'}($uri, $data);
      $request = $this->addHeaders($request, $headers);

      $response = $this->client->send($request);

      return json_decode($response->getBody());
    } catch (ClientException $e) {
      $response = $e->getResponse();
      return json_decode($response->getBody()->getContents());
    }
  }

  protected function addHeaders(RequestInterface $request,array $headers): RequestInterface
  {
    if(empty($headers)) return $request;

    foreach($headers as $name => $value) {
      $request->addHeader($name, $value);
    }

    return $request;
  }

  public function cedente(): Cedente
  {
    return $this->cedente;
  }

  public function conta(): Conta
  {
    return $this->conta;
  }

  public function convenio(): Convenio
  {
    return $this->convenio;
  }

  public function lote(): Lote
  {
    return $this->lote;
  }

  public function pdf(): PDF
  {
    return $this->pdf;
  }

}
