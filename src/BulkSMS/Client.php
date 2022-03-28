<?php

namespace Kisel\Laravel\SmsRu\BulkSMS;

use Kisel\Laravel\SmsRu\AbstractClient;

class Client extends AbstractClient
{
    public const BASE_URI = '/sms/send';

    public function send(array $to)
    {
        $uri = $this->client::BASE_URL . self::BASE_URI;
        $query = $this->client->getCredential() + ['to' => $to, 'json' => 1];

        return $this->client->getHttpClient()->get($uri, [
            'query' => $query,
        ]);
    }
}
