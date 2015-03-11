<?php
namespace WordSelector\Test;

use WordSelector\Entity\Word;
use WordSelector\WordSelector;

class WordSelectorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function testWordSelector() {

        $word = 'TEST';

        $service = \Mockery::mock('\\WordSelector\\Service\\WordService');
        $service->shouldReceive('getRandomWord')->andReturn(new Word(1, $word));

        $ws = new WordSelector($service);
        $this->assertEquals($word, $ws->getRandomWord(4));
    }
} 