<?php
namespace WordSelector;

use WordSelector\Service\WordService;

class WordSelector {

    /**
     * @var WordService
     */
    private $wordService;

    /**
     * @param WordService $wordService
     */
    public function __construct(WordService $wordService) {
        $this->wordService = $wordService;
    }

    /**
     * @param $length
     * @return string
     */
    public function getRandomWord($length) {
        return $this->wordService->getRandomWord($length)->getWord();
    }
} 