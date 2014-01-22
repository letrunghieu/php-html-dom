<?php

namespace HieuLe\PhpHtmlDom\Node;

use \HieuLe\PhpHtmlDom\Exception\DOMException;

/**
 * Element nodes are simply known as elements.
 * @link http://www.w3.org/TR/html5/dom.html#htmlelement
 *
 * @author TrungHieu
 */
class Element extends Node
{

    protected $_attributes = array();
    private $_tagName;

    public function __construct($tagName)
    {
	$this->_tagName = $tagName;
	$this->_nodeType = Node::ELEMENT_NODE;
    }

    /**
     * Get the tag name of this element
     * 
     * @return string
     */
    public function getTagName()
    {
	return $this->_tagName;
    }

    /**
     * Get the value of an attributes
     * 
     * @param string $attribute	The name of the attribute
     * @return mixed	The value of this attribute
     * @throws DOMException If the attribute name is not valid
     */
    public function getAttr($attribute)
    {
	if (!$this->isValidAttrName($attribute))
	    throw new DOMException(DOMException::INVALID_CHARACTER_ERR, "The attribute name is not valid");
	if (isset($this->_attributes[$attribute]))
	    return $this->_attributes[$attribute];
	else
	    return null;
    }

    /**
     * Set a attribute value to a new value
     * 
     * @param string $attribute	The name of the attribute
     * @param mixed $value  The value will be set to this attribute
     * @return \HieuLe\PhpHtmlDom\Node\Element
     * @throws DOMException If the attribute name is not valid
     */
    public function setAttr($attribute, $value = null)
    {
	if (!$this->isValidAttrName($attribute))
	    throw new DOMException(DOMException::INVALID_CHARACTER_ERR, "The attribute name is not valid");
	// Remove the attr if it is boolean and set to FALSE or NULL
	if ($value === FALSE || $value === NULL)
	{
	    if (isset($this->_attributes[$attribute]))
		unset($this->_attributes[$attribute]);
	}
	else
	{
	    $this->_attributes[$attribute] = $value;
	}
	return $this;
    }

    /**
     * Remove an attribute
     * 
     * @param string $attribute
     * @return \HieuLe\PhpHtmlDom\Node\Element
     * @throws DOMException If the attribute name is not valid
     */
    public function removeAttr($attribute)
    {
	return $this->setAttr($attribute);
    }

    /**
     * Get all atributes as an associated array
     * 
     * @return array
     */
    public function getAttrs()
    {
	return $this->_attributes;
    }

    public function addClass($className)
    {
	$classes = explode(" ", trim($className));
	if (!isset($this->_attributes['class']))
	{
	    $existedClasses = array();
	}
	else
	    $existedClasses = explode(" ", $this->_attributes['class']);
	$newClasses = array();
	foreach ($classes as $class)
	{
	    if (!$this->isValidAttrName($class))
		throw new DOMException(DOMException::INVALID_CHARACTER_ERR, "The class name is not valid");
	    if (!in_array($class, $existedClasses))
		$newClasses[] = $class;
	}

	$newClasses = trim(implode(" ", array_merge($existedClasses, $newClasses)));
	if ($newClasses)
	    $this->_attributes['class'] = $newClasses;
	return $this;
    }

    public function hasClass($className)
    {
	if (!isset($this->_attributes['class']))
	{
	    $existedClasses = array();
	}
	else
	    $existedClasses = explode(" ", $this->_attributes['class']);
	return in_array($className, $existedClasses);
    }

    public function removeClass($className)
    {
	$classes = explode(" ", trim($className));
	if (!isset($this->_attributes['class']))
	{
	    $existedClasses = array();
	}
	else
	    $existedClasses = explode(" ", $this->_attributes['class']);
	$newClasses = array();
	foreach ($existedClasses as $class)
	{
	    if (!in_array($class, $classes))
		$newClasses[] = $class;
	}

	$newClasses = trim(implode(" ", array_merge($existedClasses, $newClasses)));
	if ($newClasses)
	    $this->_attributes['class'] = $newClasses;
	else if (isset($this->_attributes['class']))
	    unset($this->_attributes['class']);
	
	return $this;
    }

    // @todo implement the check phase
    private function isValidAttrName($attribute)
    {
	$matches = null;
	$returnValue = preg_match('`^[a-zA-Z][a-zA-Z0-9\\-_]*$`', $attribute, $matches);

	return $returnValue;
    }

}

?>
