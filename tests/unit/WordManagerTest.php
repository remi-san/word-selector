<?php
namespace WordSelector\Test;

use WordSelector\Entity\Word;
use WordSelector\Manager\WordManager;

class WordManagerTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function testWordService()
    {

        $word = new Word(1, 'TEST', 'en');

        $repository = \Mockery::mock('\\WordSelector\\Repository\\WordRepository');
        $repository->shouldReceive('getRandomWord')->andReturn($word);

        $wm = new WordManager($repository);
        $this->assertEquals($word, $wm->getRandomWord(4, 'en'));
    }
}
