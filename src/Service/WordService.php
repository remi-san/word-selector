<?php
namespace WordSelector\Service;

use WordSelector\Entity\Word;
use WordSelector\Manager\WordManager;

class WordService
{
    /**
     * @var WordManager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param WordManager $manager The manager
     */
    public function __construct(WordManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Gets a random word of <length> characters for the <lang> language
     * <lang> must be an iso2 code in lower case
     *
     * @param  int    $length
     * @param  string $lang
     * @param  float  $complexity
     * @return Word
     */
    public function getRandomWord($length, $lang, $complexity = null)
    {
        return $this->manager->getRandomWord($length, $lang, $complexity);
    }
}
