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
    const GET_RANDOM_WORD_METHOD = 'getRandomWord';

    const LENGTH_OPTION = 'length';
    const LANG_OPTION = 'lang';
    const COMPLEXITY_OPTION = 'complexity';

    const WORD_RESPONSE = 'word';
    const LANG_RESPONSE = 'lang';
    const COMPLEXITY_RESPONSE = 'complexity';

    const ERROR_RESPONSE = 'error';

    const API_ENDPOINT = '/random';
    const HTTP_METHOD = 'GET';

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

        if ($method !== self::GET_RANDOM_WORD_METHOD) {
            throw new \InvalidArgumentException('Cannot call this method');
        }

        if (count($params) !== 3) {
            throw new \InvalidArgumentException('Cannot call this method with the given parameters');
        }

        $options = [
            self::LENGTH_OPTION => $params[0],
            self::LANG_OPTION => $params[1],
            self::COMPLEXITY_OPTION => $params[2]
        ];

        try {
            $response = $this->client->request(
                self::HTTP_METHOD,
                self::API_ENDPOINT . '?' . http_build_query($options)
            );
            $decodedJson = json_decode((string) $response->getBody());
            return new Word(
                $decodedJson->{self::WORD_RESPONSE},
                $decodedJson->{self::LANG_RESPONSE},
                $decodedJson->{self::COMPLEXITY_RESPONSE}
            );
        } catch (ClientException $e) {
            $decodedJson = json_decode((string) $e->getResponse()->getBody());
            throw new \InvalidArgumentException($decodedJson->{self::ERROR_RESPONSE});
        } catch (BadResponseException $e) {
            $exceptionBody = (string) $e->getResponse()->getBody();
            throw new \RuntimeException($exceptionBody);
        }
    }
}
