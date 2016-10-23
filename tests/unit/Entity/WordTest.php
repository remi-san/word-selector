<?php
namespace WordSelector\Test\Entity;

use Faker\Factory;
use WordSelector\Entity\Word;

class WordTest extends \PHPUnit_Framework_TestCase
{
    /** @var string */
    private $text;

    /** @var string */
    private $lang;

    /** @var int */
    private $complexity;

    public function setUp()
    {
        $faker = Factory::create();

        $this->text = $faker->word;
        $this->lang = $faker->countryISOAlpha3;
        $this->complexity = $faker->randomDigitNotNull;
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
        $word = new Word($this->text, $this->lang, $this->complexity);

        $this->assertEquals($this->text, $word->getWord());
        $this->assertEquals($this->lang, $word->getLang());
        $this->assertEquals(strlen($this->text), $word->getLength());
        $this->assertEquals($this->complexity, $word->getComplexity());
    }
}
