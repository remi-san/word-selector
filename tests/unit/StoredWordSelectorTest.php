<?php
namespace WordSelector\Test;

use Faker\Factory;
use Mockery\Mock;
use WordSelector\Entity\Word;
use WordSelector\Repository\WordRepository;
use WordSelector\StoredWordSelector;

class StoredWordSelectorTest extends \PHPUnit_Framework_TestCase
{
    /** @var int */
    private $length;

    /** @var string */
    private $lang;

    /** @var int */
    private $complexity;

    /** @var Word */
    private $word;

    /** @var WordRepository | Mock */
    private $repository;

    /** @var StoredWordSelector */
    private $serviceUnderTest;

    public function setUp()
    {
        $faker = Factory::create();

        $this->length = $faker->randomDigitNotNull;
        $this->lang = $faker->countryISOAlpha3;
        $this->complexity = $faker->randomDigitNotNull;

        $this->word = \Mockery::mock(Word::class);

        $this->repository = \Mockery::mock(WordRepository::class);

        $this->serviceUnderTest = new StoredWordSelector($this->repository);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function testWordSelector()
    {
        $this->repositoryWillReturnWord();

        $this->assertEquals(
            $this->word,
            $this->serviceUnderTest->getRandomWord($this->length, $this->lang, $this->complexity)
        );
    }

    /**
     * @test
     */
    public function testNotExistingWordSelector()
    {
        $this->repositoryWillNotReturnWord();

        $this->setExpectedException(\InvalidArgumentException::class);

        $this->serviceUnderTest->getRandomWord($this->length, $this->lang, $this->complexity);
    }

    private function repositoryWillReturnWord()
    {
        $this->repository
            ->shouldReceive('getRandomWord')
            ->with($this->length, $this->lang, $this->complexity)
            ->andReturn($this->word);
    }

    private function repositoryWillNotReturnWord()
    {
        $this->repository
            ->shouldReceive('getRandomWord')
            ->with($this->length, $this->lang, $this->complexity)
            ->andReturn(null);
    }
}
