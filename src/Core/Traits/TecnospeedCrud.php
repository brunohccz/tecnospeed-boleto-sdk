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

  /**
   * @param int $id
   * @param array $data
   */
  public function update(int $id, array $data = [])
  {
    return $this->boleto->request(
      self::UPDATE_ENDPOINT . $id,
      $data,
      'put' /* UPDATE */
    );
  }
}