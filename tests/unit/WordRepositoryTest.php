<?php
namespace WordSelector\Test;

use Doctrine\ORM\Query;
use WordSelector\Entity\Word;
use WordSelector\Repository\WordRepository;

class WordRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function testWordService()
    {
        $word = new Word(1, 'TEST', 'en');

        $configuration = \Mockery::mock('\\Doctrine\\ORM\\Configuration');
        $configuration->shouldReceive('getDefaultQueryHints')->andReturn(array());
        $configuration->shouldReceive('isSecondLevelCacheEnabled')->andReturn(false);

        $entityManager = \Mockery::mock('\\Doctrine\\ORM\\EntityManager');
        $entityManager->shouldReceive('getConfiguration')->andReturn($configuration);

        $query = \Mockery::mock(new Query($entityManager));
        $query->shouldReceive('setParameter')->andReturn($query);
        $query->shouldReceive('setMaxResults')->andReturn($query);
        $query->shouldReceive('getSingleResult')->andReturn($word);

        $entityManager = \Mockery::mock('\\Doctrine\\ORM\\EntityManager');
        $entityManager->shouldReceive('createQuery')->andReturn($query);

        $classMetadata = \Mockery::mock('\\Doctrine\\ORM\\Mapping\ClassMetadata');

        $wr = new WordRepository($entityManager, $classMetadata);
        $this->assertEquals($word, $wr->getRandomWord(4, 'en'));
    }
}
