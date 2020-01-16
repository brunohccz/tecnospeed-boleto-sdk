<?php
declare(strict_types=1);

namespace Tests;

use Tecnospeed\Boleto;
use Tecnospeed\Cedente;

class CedenteTest extends TestCase
{
   
  protected function makeCedentePayload()
  {
    return [
      'CedenteRazaoSocial'  => $this->faker->name,
      'CedenteNomeFantasia' => $this->faker->name,
      'CedenteCPFCNPJ'      => $this->faker->cnpj,
      'CedenteTelefone'     => $this->faker->phoneNumber,
      'CedenteEmail'        => $this->faker->email,
      'CedenteEnderecoLogradouro' => 'Travessa Curumim',
      'CedenteEnderecoNumero'     => '1',
      'CedenteEnderecoComplemento'=> '',
      'CedenteEnderecoBairro'     => 'Pajuçara',
      'CedenteEnderecoCEP'        => '59125-352',
      'CedenteEnderecoCidadeIBGE' => '2408102'
    ];
  }

  public function test_can_create_a_cedente()
  {
    $payload = $this->makeCedentePayload();

    $boleto = new Boleto($this->config);
    $response = $boleto->cedente()->create($payload);

    $this->assertEquals("sucesso", $response->_status);
    $this->assertEquals($payload['CedenteNomeFantasia'], $response->_dados->nomefantasia);
    $this->assertEquals($payload['CedenteCPFCNPJ'], $response->_dados->cpf_cnpj);
  }

  public function test_can_update_a_cedente()
  {
    $payload = $this->makeCedentePayload();
    $boleto = new Boleto($this->config);

    $cedenteCreated = $boleto->cedente()->create($payload);

    $payloadUpdated = $payload + [
      'CedenteNomeFantasia' => $this->faker->name
    ];

    $response = $boleto->cedente()->update(
      $cedenteCreated->_dados->id,
      $cedenteCreated->_dados->cpf_cnpj,
      $payloadUpdated
    );  

    $this->assertEquals('sucesso', $response->_status);
    $this->assertEquals($payloadUpdated['CedenteNomeFantasia'], $response->_dados->nomefantasia);
  }

}