<?php

namespace Tecnospeed\Core\Boleto;

use Tecnospeed\Core\Resource;

class PDF extends Resource
{
    const CREATE_ENDPOINT = 'boletos/impressao/lote/';
    const VIEW_ENDPOINT = 'boletos/impressao/lote/';

    /**
     * PDF normal.
     * @var int
     */
    const NORMAL = 0;

    /**
     * PDF carnê duplo (paisagem).
     * @var int
     */
    const CARNE_DUPLO = 1;

    /**
     * PDF carnê triplo (retrato).
     * @var int
     */
    const CARNE_TRIPLO = 2;

    /**
     * PDF  dupla (retrato).
     * @var int
     */
    const CARNE_DUPLA = 3;

    /**
     * PDF normal (Com marca D'água).
     * @var int
     */
    const NORMAL_MDAGUA = 4;

    /**
     * @param array $boletos
     * @param int $tipo
     */
    public function create(array $boletos, int $tipo = self::NORMAL)
    {
        return $this->boleto->request(
          self::CREATE_ENDPOINT,
          [
            'TipoImpressao' => $tipo,
            'Boletos' => $boletos
          ]
      );
    }

    /**
     * @param string $protocol
     */
    public function view(string $protocol)
    {
      return $this->boleto->baseUrl . self::VIEW_ENDPOINT . $protocol;
    }
}
