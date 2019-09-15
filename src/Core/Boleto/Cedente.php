<?php

namespace Tecnospeed\Core\Boleto;

use Tecnospeed\Core\Resource;
use Tecnospeed\Core\Traits\TecnospeedCrud;

class Cedente extends Resource
{
  use TecnospeedCrud;
  
  const CREATE_ENDPOINT = '/api/v1/cedentes/';
}