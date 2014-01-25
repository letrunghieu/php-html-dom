<?php
namespace HieuLe\PhpHtmlDom\HTML\Parser\TokenizationState;
use HieuLe\PhpHtmlDom\HTML\Parser\Token;

/**
 * Description of DataState
 *
 * @author TrungHieu
 */
class DataState extends BaseState
{
    public function consume($input, $inputLength)
    {
	if($this->isEOF($inputLength))
	    return new Token (Token::TOKEN_EOF);
	$char = $this->char($input);
	$token = new Token(Token::TOKEN_CHARACTER);
	$token->prop(Token::PROP_DATA, $char);
	return $token;
    }

    public function willChangeState($input, $inputLength)
    {
	if($this->isEOF($inputLength))
	    return false;
	$char = $this->char($input);
	switch ($char)
	{
	    case static::unihex("0026"): # '&'
		return new RefCharDataState($this->_position);
		break;
	    case static::unihex("003C"): # '<'
		return new TagOpenState($this->_position);
		break;
	}
	return false;
    }    
}

?>
