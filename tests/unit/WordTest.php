<?php
namespace WordSelector\Test;

use WordSelector\Entity\Word;

class WordTest extends \PHPUnit_Framework_TestCase
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

        $text = 'TEST';
        $lang = 'en';
        $complexity = 6;
        $word = new Word($text, $lang, $complexity);

        $this->assertEquals($text, $word->getWord());
        $this->assertEquals($lang, $word->getLang());
        $this->assertEquals(4, $word->getLength());
        $this->assertEquals(6, $word->getComplexity());
    }
}
