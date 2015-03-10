<?php
namespace WordSelector\Repository;

use Doctrine\ORM\EntityRepository;
use WordSelector\Entity\Word;

class WordRepository extends EntityRepository {

    /**
     * @param $numberOfLetters
     * @return Word
     */
    public function getRandomWord($numberOfLetters) {
        $dql = 'SELECT w, RANDOM() as HIDDEN random FROM '.$this->getClassName().' w WHERE w.length = ?1 ORDER BY random';
        return $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $numberOfLetters)
            ->setMaxResults(1)
            ->getSingleResult();
    }
} 