<?php

namespace Tecnospeed;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
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

  public function __construct(array $config = [])
  {
    $this->client = new Client([
      'base_url' => $config['api-url'],
      'defaults' => [
        'headers' => [
          'content-type' => 'application/json',
          'cnpj-cedente' => $config['cnpj-cedente'],
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

  public function request($uri, $data = [], $method = 'post')
  {
    try {
      $request = $this->{'create'.ucfirst($method).'Request'}($uri, $data);
      $response = $this->client->send($request);

      return json_decode($response->getBody());
    } catch (ClientException $e) {
      $response = $e->getResponse();
      return json_decode($response->getBody()->getContents());
    }
  }

  public function cedente()
  {
    return $this->cedente;
  }

  public function conta()
  {
    return $this->conta;
  }

  public function convenio()
  {
    return $this->convenio;
  }

  public function lote()
  {
    return $this->lote;
  }

  public function pdf()
  {
    return $this->pdf;
  }

}