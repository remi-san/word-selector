<?php

namespace WordSelector\Test\Proxy;

use Faker\Factory;
use Faker\Generator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Mockery\Mock;
use Psr\Http\Message\ResponseInterface;
use WordSelector\Entity\Word;
use WordSelector\Proxy\WordSelectorProxyAdapter;
use WordSelector\WordSelector;

class WordSelectorProxyAdapterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Generator */
    private $faker;

    /** @var string */
    private $word;

    /** @var string */
    private $lang;

    /** @var int */
    private $complexity;

    /** @var int[] */
    private $badParameters;

    /** @var int[] */
    private $goodParameters;

    /** @var string */
    private $domainExceptionResponse;

    /** @var string */
    private $validResponse;

    /** @var ResponseInterface | Mock */
    private $response;

    /** @var BadResponseException | Mock */
    private $badResponseException;

    /** @var ClientException | Mock */
    private $clientException;

    /** @var Client | Mock */
    private $client;

    /** @var WordSelectorProxyAdapter */
    private $serviceUnderTest;

    public function setUp()
    {
        $this->faker = Factory::create();

        $this->word = $this->faker->word;
        $this->lang = $this->faker->countryISOAlpha3;
        $this->complexity = $this->faker->randomDigitNotNull;

        $this->badParameters = [];
        $this->goodParameters = [
            $this->faker->randomDigitNotNull,
            $this->faker->randomDigitNotNull,
            $this->faker->randomDigitNotNull
        ];

        $this->domainExceptionResponse = json_encode(
            [ WordSelectorProxyAdapter::ERROR_RESPONSE => $this->faker->word ]
        );
        $this->validResponse = json_encode(
            [
                WordSelectorProxyAdapter::WORD_RESPONSE => $this->word,
                WordSelectorProxyAdapter::LANG_RESPONSE => $this->lang,
                WordSelectorProxyAdapter::COMPLEXITY_RESPONSE => $this->complexity
            ]
        );

        $this->response = \Mockery::mock(ResponseInterface::class);
        $this->badResponseException = \Mockery::mock(BadResponseException::class);
        $this->clientException = \Mockery::mock(ClientException::class);

        $this->client = \Mockery::mock(Client::class);

        $this->serviceUnderTest = new WordSelectorProxyAdapter($this->client);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTryingToWrapARandomClass()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $this->serviceUnderTest->call($this->faker->word, $this->faker->word);
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTryingToCallNonExistingMethod()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $this->serviceUnderTest->call(
            WordSelector::class,
            $this->faker->word
        );
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTryingToCallMethodWithBadParameters()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $this->serviceUnderTest->call(
            WordSelector::class,
            WordSelectorProxyAdapter::GET_RANDOM_WORD_METHOD,
            $this->badParameters
        );
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfRemoteAppFails()
    {
        $this->remoteAppDoesNotRespond();

        $this->setExpectedException(\RuntimeException::class);

        $this->serviceUnderTest->call(
            WordSelector::class,
            WordSelectorProxyAdapter::GET_RANDOM_WORD_METHOD,
            $this->goodParameters
        );
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfRemoteAppThrowsDomainException()
    {
        $this->remoteAppRespondsAnException();

        $this->setExpectedException(\InvalidArgumentException::class);

        $this->serviceUnderTest->call(
            WordSelector::class,
            WordSelectorProxyAdapter::GET_RANDOM_WORD_METHOD,
            $this->goodParameters
        );
    }

    /**
     * @test
     */
    public function itShouldSendAResultIfRemoteAppRespondsWithoutError()
    {
        $this->remoteAppRespondsCorrectly();

        $word = $this->serviceUnderTest->call(
            WordSelector::class,
            WordSelectorProxyAdapter::GET_RANDOM_WORD_METHOD,
            $this->goodParameters
        );

        $this->assertEquals(
            new Word($this->word, $this->lang, $this->complexity),
            $word
        );
    }

    private function remoteAppRespondsCorrectly()
    {
        $this->response->shouldReceive('getBody')->andReturn($this->validResponse);
        $this->client->shouldReceive('request')->andReturn($this->response);
    }

    private function remoteAppRespondsAnException()
    {
        $this->response->shouldReceive('getBody')->andReturn($this->domainExceptionResponse);
        $this->clientException->shouldReceive('getResponse')->andReturn($this->response);
        $this->client->shouldReceive('request')->andThrow($this->clientException);
    }

    private function remoteAppDoesNotRespond()
    {
        $this->response->shouldReceive('getBody')->andReturn($this->faker->word);
        $this->badResponseException->shouldReceive('getResponse')->andReturn($this->response);
        $this->client->shouldReceive('request')->andThrow($this->badResponseException);
    }
}
