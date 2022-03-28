<?php

namespace K1s3l\Laravel\SmsRu\Channels;

use GuzzleHttp\Client as HttpClient;
use K1s3l\Laravel\SmsRu\Factory\{
    FactoryInterface,
    MapFactory
};
use Psr\{
    Container\ContainerInterface,
    Http\Client\ClientInterface
};

/**
 * Class SmsRuApi
 *
 * @method static \K1s3l\Laravel\SmsRu\SMS\Client sms()
 * @method static \K1s3l\Laravel\SmsRu\BulkSMS\Client bulkSms()
 * @method static \K1s3l\Laravel\SmsRu\Call\Client callNumber()
 * @method static \K1s3l\Laravel\SmsRu\Callback\Client callback()
 */
class SmsRuApi
{
    public const VERSION = '1.0';

    public const BASE_URL = 'https://sms.ru';

    /**
     * @return array
     */
    private $_apiId;

    /**
     * @return ClientInterface
     */
    protected $httpClient;

    /**
     * @return ContainerInterface
     */
    protected $factory;

    public function __construct(
        array $config, ClientInterface $httpClient = new HttpClient
    )
    {
        $this->_apiId = $config['api_id'];
        $this->httpClient = $httpClient;
        $this->setFactory(
            new MapFactory(
                [
                    'sms' => SMSClient::class,
                    'bulkSms' => BulkSMSClient::class,
                    'callNumber' => CallClient::class,
                    'callback' => CallbackClient::class,
                ],
                $this
            )
        );
    }


    public function __call($name, $args)
    {
        return $this->factory->get($name);
    }

    public function setFactory(FactoryInterface&ContainerInterface $factory): self
    {
        $this->factory = $factory;

        return $this;
    }

    public function getCredential(): array
    {
        return [
            'api_id' => $this->_apiId,
            'test' => 1,
        ];
    }

    public function getHttpClient()
    {
        return $this->httpClient;
    }
}
