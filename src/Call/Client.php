<?php

namespace K1s3l\Laravel\SmsRu\Call;

use K1s3l\Laravel\SmsRu\AbstractClient;

class Client extends AbstractClient
{
    public const BASE_URI = '/callcheck/add';

    public function check(string $phone)
    {
        $uri = $this->client::BASE_URL . self::BASE_URI;
        $query = $this->client->getCredential() + ['phone' => $phone, 'json' => 1];

        return $this->client->getHttpClient()->get($uri, [
            'query' => $query,
        ]);
    }
}
