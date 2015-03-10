<?php
namespace WordSelector\Manager;

interface Manager {

    /**
     * Finds an object by its identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return object The object.
     */
    public function getById($id);

    /**
     * Finds all objects.
     *
     * @return array The objects.
     */
    public function getAll();
}