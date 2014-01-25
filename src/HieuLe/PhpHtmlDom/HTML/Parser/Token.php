<?php

namespace HieuLe\PhpHtmlDom\HTML\Parser;

use HieuLe\PhpHtmlDom\Exception\DOMException;

/**
 * The output of the tokenization step is a series of zero or more of the following tokens: DOCTYPE, start tag, end tag, comment, character, end-of-file. DOCTYPE tokens have a name, a public identifier, a system identifier, and a force-quirks flag. When a DOCTYPE token is created, its name, public identifier, and system identifier must be marked as missing (which is a distinct state from the empty string), and the force-quirks flag must be set to off (its other state is on). Start and end tag tokens have a tag name, a self-closing flag, and a list of attributes, each of which has a name and a value. When a start or end tag token is created, its self-closing flag must be unset (its other state is that it be set), and its attributes list must be empty. Comment and character tokens have data.
 * @link http://www.w3.org/TR/html5/syntax.html#tokenization
 *
 * @author TrungHieu
 */
class Token
{

    const TOKEN_DOCTYPE = 1;
    const TOKEN_START_TAG = 2;
    const TOKEN_END_TAG = 3;
    const TOKEN_COMMENT = 4;
    const TOKEN_CHARACTER = 5;
    const TOKEN_EOF = 6;
    const PROP_NAME = 10;
    const PROP_PUBLIC_ID = 11;
    const PROP_SYSTEM_ID = 12;
    const PROP_FORCE_QUIRK = 13;
    const PROP_SELF_CLOSING = 14;
    const PROP_ATTRIBUTES = 15;
    const PROP_DATA = 16;

    private $_properties = array();
    private $_type;

    public function __construct($type)
    {
	if (!in_array($type, array(self::TOKEN_DOCTYPE, self::TOKEN_START_TAG, self::TOKEN_END_TAG, self::TOKEN_COMMENT, self::TOKEN_CHARACTER, self::TOKEN_EOF)))
	    throw new DOMException(DOMException::NOT_SUPPORTED_ERR, "This type of token is not supported");
	$this->_type = $type;
	$this->_properties = array();
	switch ($type)
	{
	    case self::TOKEN_DOCTYPE:
		$this->_properties[self::PROP_NAME] = false;
		$this->_properties[self::PROP_PUBLIC_ID] = false;
		$this->_properties[self::PROP_SYSTEM_ID] = false;
		$this->_properties[self::PROP_FORCE_QUIRK] = false;
		break;
	    case self::TOKEN_START_TAG:
	    case self::TOKEN_END_TAG:
		$this->_properties[self::PROP_NAME] = false;
		$this->_properties[self::PROP_SELF_CLOSING] = false;
		$this->_properties[self::PROP_ATTRIBUTES] = array();
		break;
	    case self::TOKEN_COMMENT:
	    case self::TOKEN_CHARACTER:
		$this->_properties[self::PROP_DATA] = false;
		break;
	}
    }
    
    public function getType()
    {
	return $this->_type;
    }
    
    /**
     * Get or set the token property. If the property is not supported by this type of token, throw an exception
     * 
     * @param string $property
     * @param mixed $value  if it is NULL, return the value, otherwise set this value to the token property
     * @return \HieuLe\PhpHtmlDom\HTML\Parser\Token|mixed
     * @throws DOMException
     */
    public function prop($property, $value = null)
    {
	if (!isset($this->_properties[$property]))
	    throw new DOMException(DOMException::NOT_SUPPORTED_ERR, "This type of token does not support this property");
	if ($value === NULL)
	    return $this->_properties[$property];
	else
	    $this->_properties[$property] = $value;
	return $this;
    }

}

?>
