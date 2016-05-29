<?php

namespace WordSelector\Proxy;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use ProxyManager\Factory\RemoteObject\AdapterInterface;
use WordSelector\Entity\Word;
use WordSelector\WordSelector;

class WordSelectorProxyAdapter implements AdapterInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Construct
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Call remote object
     *
     * @param  string $wrappedClass
     * @param  string $method
     * @param  array $params
     * @return string
     */
    public function call($wrappedClass, $method, array $params = [])
    {
        if ($wrappedClass !== WordSelector::class) {
            throw new \InvalidArgumentException('Cannot call this class');
        }

        if ($method !== 'getRandomWord') {
            throw new \InvalidArgumentException('Cannot call this method');
        }

        if (count($params) !== 3) {
            throw new \InvalidArgumentException('Cannot call this method with the given parameters');
        }

        $options = [
            'length'     => $params[0],
            'lang'       => $params[1],
            'complexity' => $params[2]
        ];

        try {
            $response = $this->client->request(
                'GET',
                '/random?' . http_build_query($options)
            );
            $decodedJson = json_decode((string) $response->getBody());
            return new Word(
                $decodedJson->word,
                $decodedJson->lang,
                $decodedJson->complexity
            );
        } catch (ClientException $e) {
            $decodedJson = json_decode((string) $e->getResponse()->getBody());
            throw new \InvalidArgumentException($decodedJson->error);
        } catch (BadResponseException $e) {
            $exceptionBody = (string) $e->getResponse()->getBody();
            throw new \RuntimeException($exceptionBody);
        }
    }
}
