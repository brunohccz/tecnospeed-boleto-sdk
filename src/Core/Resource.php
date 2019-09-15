<?php

namespace Tecnospeed\Core;

use Tecnospeed\Boleto;

class Resource
{
  /**
   * @var Boleto;
   */
  protected $boleto;

  /**
   * @param Boleto $boleto
   */
  public function __construct(Boleto $boleto)
  {
    $this->boleto = $boleto;
  }
}