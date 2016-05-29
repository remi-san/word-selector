<?php

namespace WordSelector\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use WordSelector\Entity\Word;
use WordSelector\Proxy\WordSelectorProxyAdapter;
use WordSelector\WordSelector;

class WordSelectorProxyAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->client = \Mockery::mock(Client::class);
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

        $adapter = new WordSelectorProxyAdapter($this->client);
        $adapter->call('RandomClass', 'randomMethod');
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTryingToCallNonExistingMethod()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $adapter = new WordSelectorProxyAdapter($this->client);
        $adapter->call(WordSelector::class, 'nonExistingMethod');
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTryingToCallMethodWithBadParameters()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $adapter = new WordSelectorProxyAdapter($this->client);
        $adapter->call(WordSelector::class, 'getRandomWord', []);
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfRemoteAppFails()
    {
        $this->setExpectedException(\RuntimeException::class);

        $response = \Mockery::mock(ResponseInterface::class, function ($response) {
            $response->shouldReceive('getBody')->andReturn('failed');
        });
        $exception = \Mockery::mock(BadResponseException::class, function ($exception) use ($response) {
            $exception->shouldReceive('getResponse')->andReturn($response);
        });

        $this->client->shouldReceive('request')->andThrow($exception);

        $adapter = new WordSelectorProxyAdapter($this->client);
        $adapter->call(WordSelector::class, 'getRandomWord', [1, 1, 1]);
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfRemoteAppThrowsDomainException()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $response = \Mockery::mock(ResponseInterface::class, function ($response) {
            $response->shouldReceive('getBody')->andReturn('{"error" : "error"}');
        });
        $exception = \Mockery::mock(ClientException::class, function ($exception) use ($response) {
            $exception->shouldReceive('getResponse')->andReturn($response);
        });

        $this->client->shouldReceive('request')->andThrow($exception);

        $adapter = new WordSelectorProxyAdapter($this->client);
        $adapter->call(WordSelector::class, 'getRandomWord', [1, 1, 1]);
    }

    /**
     * @test
     */
    public function itShouldSendAResultIfRemoteAppRespondsWithoutError()
    {
        $response = \Mockery::mock(ResponseInterface::class, function ($response) {
            $response
                ->shouldReceive('getBody')
                ->andReturn(json_encode(
                    [
                        'word' => 'word',
                        'lang' => 'lang',
                        'complexity' => 1
                    ]
                ));
        });

        $this->client->shouldReceive('request')->andReturn($response);

        $adapter = new WordSelectorProxyAdapter($this->client);
        $word = $adapter->call(WordSelector::class, 'getRandomWord', [1, 1, 1]);

        $this->assertEquals(new Word('word', 'lang', 1), $word);
    }
}
