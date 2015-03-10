<?php
namespace WordSelector\Util\Doctrine;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Query\SqlWalker;

/**
 * RandFunction ::= "RANDOM" "(" ")"
 */
class Random extends FunctionNode
{

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        switch($sqlWalker->getConnection()->getDatabasePlatform()->getName()) {
            case 'postgresql': return 'RANDOM()'; break;
            case 'mysql': return 'RAND()'; break;
            default: throw new QueryException("You can't use RANDOM()!");
        }
    }
}