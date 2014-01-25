<?php

namespace HieuLe\PhpHtmlDom\HTML\Parser\TokenizationState;

/**
 * The tokenizer state machine consists of the states inherited from this base class
 *
 * @author TrungHieu
 */
abstract class BaseState
{

    protected $_position;
    
    public function __construct($currentPosition)
    {
	$this->_position = $currentPosition;
    }

    /**
     * Consume the next character and emit a token
     * 
     * @return Token
     */
    public abstract function consume($input, $inputLength);
    
    public abstract function willChangeState($input, $inputLength);

    /**
     * Get the curernt character position
     * 
     * @return int
     */
    public function getPosition()
    {
	return $this->_position;
    }
    
    /**
     * Determine whether finish the input string
     * 
     * @param integer $inputLength
     * @return boolean
     */
    public function isEOF($inputLength)
    {
	return $this->_position >= $inputLength;
    }
    
    /**
     * Get the character at the current position
     * 
     * @param string $input
     * @return tring
     */
    public function char($input)
    {
	return $input[$this->_position];
    }

    /**
     * Return unicode char by its code
     *
     * @param int $u
     * @return char
     */
    public static function unihex($hex)
    {
	return mb_convert_encoding('&#x' . $hex . ';', 'UTF-8', 'HTML-ENTITIES');
    }

}
