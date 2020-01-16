<?php
declare(strict_types=1);

namespace Tests;

use Tecnospeed\Boleto;

class ContaTest extends TestCase
{
  protected function makeContaPayload()
  {
    $contaAgencia = (string) $this->faker->numberBetween(1000, 9999);
    $contaNumero = (string) $this->faker->numberBetween(1000, 99999);
    
    return [
      "ContaCodigoBanco" => "341",
      "ContaAgencia"     => $contaAgencia,
      "ContaAgenciaDV"   => "1",
      "ContaNumero"      => $contaNumero,
      "ContaNumeroDV"    => "3",
      "ContaTipo"        => "CORRENTE",
      "ContaCodigoBeneficiario" => $contaNumero
    ];
  }

  public function test_can_create_a_conta()
  {
    $payload = $this->makeContaPayload();

    $boleto = new Boleto($this->config + [
      'cnpj-cedente' => '38569752000140'
    ]);

    $response = $boleto->conta()->create($payload);

    $this->assertEquals('sucesso', $response->_status);
    $this->assertEquals($payload['ContaAgencia'], $response->_dados->agencia);
  }
}
