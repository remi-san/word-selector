<?php
namespace WordSelector\Test;

use WordSelector\Entity\Word;
use WordSelector\Service\WordService;

class WordServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function testWordService() {

        $word = new Word(1, 'TEST', 'en');

        $manager = \Mockery::mock('\\WordSelector\\Manager\\WordManager');
        $manager->shouldReceive('getRandomWord')->andReturn($word);
        $manager->shouldReceive('getById')->andReturn($word);
        $manager->shouldReceive('getAll')->andReturn(array($word));

        $ws = new WordService($manager);
        $this->assertEquals($word, $ws->getRandomWord(4, 'en'));
        $this->assertEquals($word, $ws->getById(1));
        $this->assertEquals(array($word), $ws->getAll());
    }
} 