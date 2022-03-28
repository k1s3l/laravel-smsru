<?php

namespace K1s3l\Laravel\SmsRu;

use K1s3l\Laravel\SmsRu\Channels\SmsRuApi;

abstract class AbstractClient
{
    protected $client;

    public function __construct(SmsRuApi $client)
    {
        $this->client = $client;
    }
}
