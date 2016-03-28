<?php
namespace WordSelector\Repository;

use WordSelector\Entity\DoctrineWord;

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
     * @return DoctrineWord
     */
    public function getRandomWord($length, $lang, $complexity = null);
}