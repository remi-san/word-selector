<?php
namespace WordSelector\Test;

use WordSelector\Entity\Word;
use WordSelector\Manager\WordManager;

class WordManagerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function testWordService() {

        $word = new Word(1, 'TEST', 'en');

        $repository = \Mockery::mock('\\WordSelector\\Repository\\WordRepository');
        $repository->shouldReceive('getRandomWord')->andReturn($word);
        $repository->shouldReceive('find')->andReturn($word);
        $repository->shouldReceive('findAll')->andReturn(array($word));

        $wm = new WordManager($repository);
        $this->assertEquals($word, $wm->getRandomWord(4, 'en'));
        $this->assertEquals($word, $wm->getById(1));
        $this->assertEquals(array($word), $wm->getAll());
    }
} 