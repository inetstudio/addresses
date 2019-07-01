<?php

namespace InetStudio\AddressesPackage\Points\Services\Back;

use GuzzleHttp\Client;
use InetStudio\AddressesPackage\Points\Contracts\Services\Back\AHunterServiceContract;

/**
 * Class AHunterService.
 */
class AHunterService implements AHunterServiceContract
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $ahunterUrl = '';

    /**
     * AHunterService constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->ahunterUrl = config('services.ahunter.search_url');
    }

    /**
     * Получаем распознанный адрес из сервиса.
     *
     * @param  string  $address
     *
     * @return array
     */
    public function recognizeAddress(string $address): array
    {
        $url = $this->ahunterUrl.$address;

        $response = $this->client->post($url);
        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }
}
