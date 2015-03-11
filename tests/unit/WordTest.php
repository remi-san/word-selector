<?php
namespace WordSelector\Test;

use WordSelector\Entity\Word;

class WordTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function testWordSelector() {

        $text = 'TEST';
        $word = new Word(3, $text);

        $this->assertEquals(3, $word->getId());
        $this->assertEquals($text, $word->getWord());
        $this->assertEquals(4, $word->getLength());
        $this->assertEquals(3, $word->getNbLetters());
        $this->assertEquals(27/16, $word->getComplexity());
    }
} 