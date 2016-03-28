<?php
namespace WordSelector\Test;

use WordSelector\Entity\Word;
use WordSelector\Repository\WordRepository;
use WordSelector\StoredWordSelector;

class WordSelectorTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function testWordSelector()
    {
        $wordObject = new Word('TEST', 'en', 5);

        $repository = \Mockery::mock(WordRepository::class);
        $repository->shouldReceive('getRandomWord')->andReturn($wordObject);

        $ws = new StoredWordSelector($repository);
        $this->assertEquals($wordObject, $ws->getRandomWord(4, 'en'));
    }
}
