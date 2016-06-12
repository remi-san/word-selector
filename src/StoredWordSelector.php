<?php

namespace WordSelector;

use WordSelector\Entity\Word;
use WordSelector\Repository\WordRepository;

class StoredWordSelector implements WordSelector
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
     *
     * @throws \InvalidArgumentException
     *
     * @return Word
     */
    public function getRandomWord($length, $lang = 'en', $complexity = null)
    {
        $word = $this->wordRepository->getRandomWord($length, $lang, $complexity);

        if (!$word) {
            throw new \InvalidArgumentException('Could not find a word');
        }

        return $word;
    }
}
