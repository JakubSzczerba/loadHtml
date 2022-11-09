<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class DataProvider
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function serializeData()
    {
        $response = $this->client->request('GET', 'http://estoremedia.space/DataIT/')
            ->getContent();

        return $response;
    }

}