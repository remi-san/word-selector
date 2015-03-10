<?php
namespace WordSelector\Manager;

class WordManager extends AbstractManager {

    /**
     * @param $numberOfLetters
     * @return Word
     */
    public function getRandomWord($numberOfLetters) {
        return $this->repository->getRandomWord($numberOfLetters);
    }
} 