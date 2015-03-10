<?php
namespace WordSelector\Entity;

/**
 * @Entity(repositoryClass="\WordSelector\Repository\WordRepository")
 * @Table(name="words.en")
 **/
class Word {

    /**
     * @var int
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     **/
    private $id;

    /**
     * @var string
     * @Column(type="string")
     **/
    private $word;

    /**
     * @var int
     * @Column(type="integer",name="len")
     **/
    private $length;

    /**
     * @var int
     * @Column(type="integer",name="letters_nb")
     */
    private $nbLetters;

    /**
     * @var float
     * @Column(type="float")
     */
    private $complexity;

    /**
     * Constructor
     *
     * @param string $word
     */
    function __construct($word)
    {
        $this->word = $word;
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
    private function nbLetters() {
        $this->nbLetters = count(array_unique(str_split($this->word)));
    }

    /**
     * Calculate the complexity of the word
     */
    private function complexity() {
        $this->complexity = ($this->nbLetters*$this->nbLetters*$this->nbLetters)/($this->length*$this->length);
    }
}