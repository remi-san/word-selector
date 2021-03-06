<?php

namespace WordSelector\Repository;

use WordSelector\Entity\Word;

interface WordRepository
{
    /**
     * Gets a random word of <length> characters for the <lang> language
     * <lang> must be an iso2 code in lower case
     *
     * @param  int    $length
     * @param  string $lang
     * @param  float  $complexity
     *
     * @return Word
     */
    public function getRandomWord($length, $lang, $complexity = null);
}
