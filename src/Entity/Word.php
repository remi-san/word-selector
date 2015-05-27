<?php
namespace WordSelector\Entity;

/**
 * @Entity(repositoryClass="\WordSelector\Repository\WordRepository")
 * @Table(name="wordselector.word")
 **/
class Word {

    /**
     * @var int
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     **/
    protected $id;

    /**
     * @var string
     * @Column(type="string")
     **/
    protected $word;

    /**
     * @var int
     * @Column(type="integer",name="len")
     **/
    protected $length;

    /**
     * @var float
     * @Column(type="string")
     **/
    protected $lang;

    /**
     * @var int
     * @Column(type="integer",name="letters_nb")
     */
    protected $nbLetters;

    /**
     * @var float
     * @Column(type="float")
     */
    protected $complexity;

    /**
     * Constructor
     *
     * @param int    $id
     * @param string $word
     * @param string $lang
     */
    function __construct($id, $word, $lang)
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
    protected function nbLetters() {
        $this->nbLetters = count(array_unique(str_split($this->word)));
    }

    /**
     * Calculate the complexity of the word
     */
    protected function complexity() {
        $this->complexity = ($this->nbLetters*$this->nbLetters*$this->nbLetters)/($this->length*$this->length);
    }
}