<?php

namespace WordSelector\Entity;

class Word
{
    /**
     * @var string
     **/
    protected $word;

    /**
     * @var int
     **/
    protected $length;

    /**
     * @var float
     **/
    protected $lang;

    /**
     * @var float
     */
    protected $complexity;

    /**
     * Constructor
     *
     * @param string $word
     * @param string $lang
     * @param float  $complexity
     */
    public function __construct($word, $lang, $complexity)
    {
        $this->word = $word;
        $this->lang = $lang;
        $this->length = strlen($this->word);
        $this->complexity = $complexity;
    }

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return float
     */
    public function getComplexity()
    {
        return $this->complexity;
    }
}