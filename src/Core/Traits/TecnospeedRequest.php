<?php

namespace Tecnospeed\Core\Traits;

use GuzzleHttp\Exception\ClientException;

trait TecnospeedRequest
{
  private function createPostRequest(string $uri, array $data = [])
  {
    try {
      return $this->client->createRequest('POST', $uri, ['json' => $data]);
    } catch (ClientException $e) {
      $response = $e->getResponse();
      return json_decode($response->getBody()->getContents());
    }
  }

  private function createGetRequest(string $uri, array $query = [])
  {
    try {
      return $this->client->createRequest('GET', $uri, ['query' => $query]);
    } catch (ClientException $e) {
      $response = $e->getResponse();
      return json_decode($response->getBody()->getContents());
    }
  }

}