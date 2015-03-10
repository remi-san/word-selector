<?php
namespace WordSelector\Manager;

use Doctrine\ORM\EntityRepository;

abstract class AbstractManager implements Manager {

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * Constructor
     *
     * @param EntityRepository $repository The repository
     */
    public function __construct(EntityRepository $repository)
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
} 