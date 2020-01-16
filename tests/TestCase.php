<?php

namespace Tests;

use JansenFelipe\FakerBR\FakerBR;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Faker;

abstract class TestCase extends BaseTestCase
{
  /**
   * @var Faker
   */
  protected $faker;

  /**
   * Base config plug boleto tecnospeed
   * @var array
   */
  protected $config;

  public function setUp(): void
  {
    parent::setUp();

    $this->faker = Faker\Factory::create('pt_BR');
    $this->faker->addProvider(new FakerBR($this->faker));

    $this->config = [
      'api-url' => 'http://homologacao.cobrancabancaria.tecnospeed.com.br:8080/',
      'hash-sh' => 'f22b97c0c9a3d41ac0a3875aba69e5aa',
      'cnpj-sh' => '01001001000113'
    ];
  }
}