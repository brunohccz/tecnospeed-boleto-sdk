<?php

namespace Tecnospeed\Core\Boleto;

use Tecnospeed\Core\Resource;
use Tecnospeed\Core\Traits\TecnospeedCrud;

class Lote extends Resource
{
  use TecnospeedCrud;
  
  const CREATE_ENDPOINT = '/api/v1/boletos/lote/';
  const STATUS_ENDPOINT = '/api/v1/boletos/';
  
  /**
   * @param array $data
   */
  public function consultar(array $data)
  {
    return $this->boleto->request(
      self::STATUS_ENDPOINT,
      $data,
      'get'
    );
  }
}