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

    /**
     * HTML void element as defined as {@link http://www.w3.org/TR/html5/syntax.html#void-elements}
     *
     * @var type 
     */
    protected static $voidElements = array(
        'area'   => true,
        'base'   => true,
        'br'     => true,
        'col'    => true,
        'embed'  => true,
        'hr'     => true,
        'img'    => true,
        'input'  => true,
        'keygen' => true,
        'link'   => true,
        'meta'   => true,
        'param'  => true,
        'source' => true,
        'track'  => true,
        'wbr'    => true,
    );
    protected $_attributes         = array();
    private $_tagName;
    private $_isSelfClosing        = false;

    public function __construct($tagName)
    {
        parent::__construct();
        $this->_tagName       = trim($tagName);
        $this->_nodeType      = Node::ELEMENT_NODE;
        if (isset(self::$voidElements[$this->_tagName]))
            $this->_isSelfClosing = true;
    }

    public function isSelfClosing()
    {
        return $this->_isSelfClosing;
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

    /**
     * Add one or more class. Each class is separated by spaces
     * 
     * @param tring $className
     * @return \HieuLe\PhpHtmlDom\Node\Element
     * @throws DOMException
     */
    public function addClass($className)
    {
        $classes = explode(" ", trim($className));
        if (!isset($this->_attributes['class']))
        {
            $existedClasses = array();
        }
        else
            $existedClasses = explode(" ", $this->_attributes['class']);
        $newClasses     = array();
        foreach ($classes as $class)
        {
            if (!$this->isValidAttrName($class))
                throw new DOMException(DOMException::INVALID_CHARACTER_ERR, "The class name is not valid");
            if (!in_array($class, $existedClasses))
                $newClasses[] = $class;
        }

        $newClasses                 = trim(implode(" ", array_merge($existedClasses, $newClasses)));
        if ($newClasses)
            $this->_attributes['class'] = $newClasses;
        return $this;
    }

    /**
     * Check whether a class is exist in this element
     * 
     * @param string $className
     * @return boolean
     */
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

    /**
     * Remove one or more class, each class is separated by spaces
     * 
     * @param string $className
     * @return \HieuLe\PhpHtmlDom\Node\Element
     */
    public function removeClass($className)
    {
        $classes = explode(" ", trim($className));
        if (!isset($this->_attributes['class']))
        {
            $existedClasses = array();
        }
        else
            $existedClasses = explode(" ", $this->_attributes['class']);
        $newClasses     = array();
        foreach ($existedClasses as $class)
        {
            if (!in_array($class, $classes))
                $newClasses[] = $class;
        }

        $newClasses                 = trim(implode(" ", $newClasses));
        if ($newClasses)
            $this->_attributes['class'] = $newClasses;
        else if (isset($this->_attributes['class']))
            unset($this->_attributes['class']);

        return $this;
    }

    public function appendText($text)
    {
        $textNode = new Text($text);
        $this->appendChild($textNode);
        return $this;
    }

// @todo implement the check phase
    private function isValidAttrName($attribute)
    {
        $matches     = null;
        $returnValue = preg_match('`^[a-zA-Z][a-zA-Z0-9\\-_]*$`', $attribute, $matches);

        return $returnValue;
    }

    public function __toString()
    {
        return $this->html();
    }

}
