<?php

namespace Tecnospeed\Core\Boleto;

use Tecnospeed\Core\Resource;
use Tecnospeed\Core\Traits\TecnospeedCrud;

class Cedente extends Resource
{
  use TecnospeedCrud;

  const CREATE_ENDPOINT = '/api/v1/cedentes/';
  
  const UPDATE_ENDPOINT = '/api/v1/cedentes/';

  const CONTAS_ENDPOINT = '/api/v1/cedentes/contas';
  
  public function update(int $id, string $cnpj, array $data)
  {
    return $this->boleto->request(
      static::UPDATE_ENDPOINT . $id,
      $data,
      'put',
      [
        'cnpj-cedente' => $cnpj
      ]
    );
  }
}