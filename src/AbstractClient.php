<?php

namespace Kisel\Laravel\SmsRu;

use Kisel\Laravel\SmsRu\Channels\SmsRuApi;

abstract class AbstractClient
{
    protected $client;

    public function __construct(SmsRuApi $client)
    {
        $this->client = $client;
    }
}
