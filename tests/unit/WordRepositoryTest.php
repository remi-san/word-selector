<?php
namespace WordSelector\Test;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use WordSelector\Entity\Word;
use WordSelector\Manager\WordManager;
use WordSelector\Repository\WordRepository;

class WordRepositoryTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function testWordService() {

        $word = new Word(1, 'TEST');

        $entityManager = \Mockery::mock('\\Doctrine\\ORM\\EntityManager');

        $query = \Mockery::mock(new Query($entityManager));
        $query->shouldReceive('setParameter')->andReturn($query);
        $query->shouldReceive('setMaxResults')->andReturn($query);
        $query->shouldReceive('getSingleResult')->andReturn($word);

        $entityManager = \Mockery::mock('\\Doctrine\\ORM\\EntityManager');
        $entityManager->shouldReceive('createQuery')->andReturn($query);

        $classMetadata = \Mockery::mock('\\Doctrine\\ORM\\Mapping\ClassMetadata');

        $wr = new WordRepository($entityManager, $classMetadata);
        $this->assertEquals($word, $wr->getRandomWord(5));
    }
} 