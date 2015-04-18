<?php
namespace WordSelector\Service;

use WordSelector\Entity\Word;

class WordService extends AbstractService implements Service {

    /**
     * Gets a random word of <length> characters for the <lang> language
     * <lang> must be an iso2 code in lower case
     *
     * @param  int    $length
     * @param  string $lang
     * @param  float  $complexity
     * @return Word
     */
    public function getRandomWord($length, $lang, $complexity = null) {
        return $this->manager->getRandomWord($length, $lang, $complexity);
    }
} 