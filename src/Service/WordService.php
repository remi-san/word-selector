<?php
namespace WordSelector\Service;

use WordSelector\Entity\Word;

class WordService extends AbstractService implements Service {

    /**
     * @param $numberOfLetters
     * @return Word
     */
    public function getRandomWord($numberOfLetters) {
        return $this->manager->getRandomWord($numberOfLetters);
    }
} 