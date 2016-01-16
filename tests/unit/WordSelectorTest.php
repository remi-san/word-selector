<?php
namespace WordSelector\Test;

use WordSelector\Entity\Word;
use WordSelector\Repository\WordRepository;
use WordSelector\DoctrineWordSelector;

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
        $word = 'TEST';

        $repository = \Mockery::mock(WordRepository::class);
        $repository->shouldReceive('getRandomWord')->andReturn(new Word(1, $word, 'en'));

        $ws = new DoctrineWordSelector($repository);
        $this->assertEquals($word, $ws->getRandomWord(4, 'en'));
    }
}
