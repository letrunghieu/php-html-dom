<?php

namespace HieuLe\PhpHtmlDom;

/**
 * Element nodes are simply known as elements.
 * @link http://www.w3.org/TR/html5/dom.html#htmlelement
 *
 * @author TrungHieu
 */
class Element extends Node
{

    protected $_attributes;
    
    public function __construct()
    {
	$this->_nodeType = Node::ELEMENT_NODE;
    }

}

?>
