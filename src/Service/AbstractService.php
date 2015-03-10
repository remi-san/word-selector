<?php
namespace WordSelector\Service;

use WordSelector\Manager\Manager;

abstract class AbstractService implements Service {

    /**
     * @var Manager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param Manager $manager The manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
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
        return $this->manager->getById($id);
    }

    /**
     * Finds all objects.
     *
     * @return array The objects.
     */
    public function getAll()
    {
        return $this->manager->getAll();
    }
} 