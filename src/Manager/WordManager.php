<?php
namespace WordSelector\Manager;

use WordSelector\Entity\Word;

class WordManager extends AbstractManager {

    /**
     * @param $numberOfLetters
     * @return Word
     */
    public function getRandomWord($numberOfLetters) {
        return $this->repository->getRandomWord($numberOfLetters);
    }
} 