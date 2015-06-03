<?php
namespace WordSelector\Manager;

use WordSelector\Entity\Word;
use WordSelector\Repository\WordRepository;

class WordManager {

    /**
     * @var WordRepository
     */
    protected $repository;

    /**
     * Constructor
     *
     * @param WordRepository $repository The repository
     */
    public function __construct(WordRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Finds an object by its identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return object The object.
     */
    public function getById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Finds all objects.
     *
     * @return array The objects.
     */
    public function getAll()
    {
        return $this->repository->findAll();
    }

    /**
     * Gets a random word of <length> characters for the <lang> language
     * <lang> must be an iso2 code in lower case
     *
     * @param  int    $length
     * @param  string $lang
     * @param  float  $complexity
     * @return Word
     */
    public function getRandomWord($length, $lang, $complexity = null)
    {
        return $this->repository->getRandomWord($length, $lang, $complexity);
    }
} 