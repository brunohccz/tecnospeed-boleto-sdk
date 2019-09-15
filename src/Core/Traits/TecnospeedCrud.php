<?php

namespace Tecnospeed\Core\Traits;

trait TecnospeedCrud
{
  /**
   * @param array $data
   */
  public function create(array $data = [])
  {
    return $this->boleto->request(
      self::CREATE_ENDPOINT,
      $data
    );
  }
}