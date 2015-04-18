<?php
namespace WordSelector;

use WordSelector\Service\WordService;

class WordSelector {

    /**
     * @var WordService
     */
    private $wordService;

    /**
     * Constructor
     *
     * @param WordService $wordService
     */
    public function __construct(WordService $wordService) {
        $this->wordService = $wordService;
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
    public function getRandomWord($length, $lang = 'en', $complexity = null) {
        return $this->wordService->getRandomWord($length, $lang, $complexity)->getWord();
    }
} 