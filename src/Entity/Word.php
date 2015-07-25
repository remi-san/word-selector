<?php
namespace WordSelector\Entity;

class Word
{
    /**
     * @var int
     **/
    protected $id;

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
     * @var int
     */
    protected $nbLetters;

    /**
     * @var float
     */
    protected $complexity;

    /**
     * Constructor
     *
     * @param int    $id
     * @param string $word
     * @param string $lang
     */
    public function __construct($id, $word, $lang)
    {
        $this->id = $id;
        $this->word = $word;
        $this->lang = $lang;
        $this->length = strlen($this->word);
        $this->nbLetters();
        $this->complexity();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
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
     * @return float
     */
    public function getComplexity()
    {
        return $this->complexity;
    }

    /**
     * @return int
     */
    public function getNbLetters()
    {
        return $this->nbLetters;
    }

    /**
     * Calculate the number of different letters in the word
     */
    protected function nbLetters()
    {
        $this->nbLetters = count(array_unique(str_split($this->word)));
    }

    /**
     * Calculate the complexity of the word
     */
    protected function complexity()
    {
        $this->complexity = ($this->nbLetters*$this->nbLetters*$this->nbLetters)/($this->length*$this->length);
    }
}
