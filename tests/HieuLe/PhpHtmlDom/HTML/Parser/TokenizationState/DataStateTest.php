<?php

use HieuLe\PhpHtmlDom\HTML\Parser\TokenizationState\DataState;
use HieuLe\PhpHtmlDom\HTML\Parser\TokenizationState\TagOpenState;
use HieuLe\PhpHtmlDom\HTML\Parser\TokenizationState\RefCharDataState;
use HieuLe\PhpHtmlDom\HTML\Parser\Token;

/**
 * Description of DataStateTest
 *
 * @author TrungHieu
 */
class DataStateTest extends PHPUnit_Framework_TestCase
{
    public function testWillChangeState()
    {
	$state = new DataState(0);
	$this->assertFalse($state->willChangeState(" ", 0));
	$this->assertFalse($state->willChangeState("x", 1));
	
	
	$this->assertInstanceOf('HieuLe\PhpHtmlDom\HTML\Parser\TokenizationState\TagOpenState', $state->willChangeState("<", 1));
	$this->assertInstanceOf('HieuLe\PhpHtmlDom\HTML\Parser\TokenizationState\RefCharDataState', $state->willChangeState("&", 1));
    }
    
    public function testConsume()
    {
	$state = new DataState(0);
	
	$token = $state->consume("", 0);
	$this->assertSame(HieuLe\PhpHtmlDom\HTML\Parser\Token::TOKEN_EOF, $token->getType());
	
	$token = $state->consume("x", 1);
	$this->assertSame("x", $token->prop(Token::PROP_DATA));
    }
}

?>
