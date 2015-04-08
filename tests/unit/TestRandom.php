<?php
/**
 * Created by PhpStorm.
 * User: remi
 * Date: 12/03/15
 * Time: 00:17
 */

namespace WordSelector\Test;


use WordSelector\Util\Doctrine\Random;

class TestRandom  extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function testRandomMySql() {

        $parser = \Mockery::mock('\\Doctrine\\ORM\\Query\\Parser');
        $parser->shouldReceive('match')->times(3);

        $platform = \Mockery::mock('\\Doctrine\\DBAL\\Platforms\\AbstractPlatform');
        $platform->shouldReceive('getName')->andReturn('mysql');

        $connection = \Mockery::mock('\\Doctrine\\DBAL\\Connection');
        $connection->shouldReceive('getDatabasePlatform')->andReturn($platform);

        $walker = \Mockery::mock('\\Doctrine\\ORM\\Query\\SqlWalker');
        $walker->shouldReceive('getConnection')->andReturn($connection);

        $random = new Random('random');
        $random->parse($parser);

        $this->assertEquals('RAND()', $random->getSql($walker));
    }

    /**
     * @test
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function testRandomPostgresql() {

        $parser = \Mockery::mock('\\Doctrine\\ORM\\Query\\Parser');
        $parser->shouldReceive('match')->times(3);

        $platform = \Mockery::mock('\\Doctrine\\DBAL\\Platforms\\AbstractPlatform');
        $platform->shouldReceive('getName')->andReturn('postgresql');

        $connection = \Mockery::mock('\\Doctrine\\DBAL\\Connection');
        $connection->shouldReceive('getDatabasePlatform')->andReturn($platform);

        $walker = \Mockery::mock('\\Doctrine\\ORM\\Query\\SqlWalker');
        $walker->shouldReceive('getConnection')->andReturn($connection);

        $random = new Random('random');
        $random->parse($parser);

        $this->assertEquals('RANDOM()', $random->getSql($walker));
    }

    /**
     * @test
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function testRandomOracle() {

        $this->setExpectedException('\\Doctrine\\ORM\\Query\\QueryException');

        $parser = \Mockery::mock('\\Doctrine\\ORM\\Query\\Parser');
        $parser->shouldReceive('match')->times(3);

        $platform = \Mockery::mock('\\Doctrine\\DBAL\\Platforms\\AbstractPlatform');
        $platform->shouldReceive('getName')->andReturn('oracle');

        $connection = \Mockery::mock('\\Doctrine\\DBAL\\Connection');
        $connection->shouldReceive('getDatabasePlatform')->andReturn($platform);

        $walker = \Mockery::mock('\\Doctrine\\ORM\\Query\\SqlWalker');
        $walker->shouldReceive('getConnection')->andReturn($connection);

        $random = new Random('random');
        $random->parse($parser);

        $random->getSql($walker);
    }
} 