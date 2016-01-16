<?php
namespace WordSelector;

interface WordSelector
{
    /**
     * Gets a random word of <length> characters for the <lang> language
     * <lang> must be an iso2 code in lower case
     *
     * @param  int    $length
     * @param  string $lang
     * @param  float  $complexity
     * @return string
     */
    public function getRandomWord($length, $lang = 'en', $complexity = null);
}
