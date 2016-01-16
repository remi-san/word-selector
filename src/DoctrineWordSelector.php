<?php
namespace WordSelector;

use WordSelector\Repository\WordRepository;

class DoctrineWordSelector implements WordSelector
{
    /**
     * @var WordRepository
     */
    private $wordRepository;

    /**
     * Constructor
     *
     * @param WordRepository $wordRepository
     */
    public function __construct(WordRepository $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }

    /**
     * Gets a random word of <length> characters for the <lang> language
     * <lang> must be an iso2 code in lower case
     *
     * @param  int    $length
     * @param  string $lang
     * @param  float  $complexity
     * @return string
     */
    public function getRandomWord($length, $lang = 'en', $complexity = null)
    {
        return $this->wordRepository->getRandomWord($length, $lang, $complexity)->getWord();
    }
}
