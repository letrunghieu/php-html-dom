<?php

namespace HieuLe\PhpHtmlDom\Node;

/**
 * Objects implementing the Document, DocumentFragment, DocumentType, Element, Text, ProcessingInstruction, or Comment interface (simply called nodes) participate in a tree, simply named the node tree. 
 * @link http://dom.spec.whatwg.org/#concept-node
 * 
 * @author TrungHieu
 */
class Node
{

    const ELEMENT_NODE = 1;
    const TEXT_NODE = 3;
    const PROCESSING_INSTRUCTION_NODE = 7;
    const COMMENT_NODE = 8;
    const DOCUMENT_NODE = 9;
    const DOCUMENT_TYPE_NODE = 10;
    const DOCUMENT_FRAGMENT_NODE = 11;
    const DOCUMENT_POSITION_DISCONNECTED = 0x01;
    const DOCUMENT_POSITION_PRECEDING = 0x02;
    const DOCUMENT_POSITION_FOLLOWING = 0x04;
    const DOCUMENT_POSITION_CONTAINS = 0x08;
    const DOCUMENT_POSITION_CONTAINED_BY = 0x10;
    const DOCUMENT_POSITION_IMPLEMENTATION_SPECIFIC = 0x20;

    protected $_nodeType;
    protected $_nodeName;
    protected $_ownerDocument;

    /**
     *
     * @var Node
     */
    protected $_parentNode;
    protected $_parentElement;

    /**
     *
     * @var NodeList
     */
    protected $_childNodes;
    protected $_nodeValue;
    protected $_textContent;

    /**
     * The hasChildNodes() method must return true if the context object has children, and false otherwise. 
     * 
     * @return boolean
     */
    public function hasChildNodes()
    {
	return !$this->_childNodes->isEmpty();
    }

    /**
     * The first child of an object is its first child or null if it has no child. 
     * 
     * @return Node Description
     */
    public function firstChild()
    {
	
    }

    /**
     * The last child of an object is its last child or null if it has no child. 
     * 
     * @return Node
     */
    public function lastChild()
    {
	
    }

    /**
     * The previous sibling of an object is its first preceding sibling or null if it has no preceding sibling. 
     * 
     * @return Node
     */
    public function previousSibling()
    {
	
    }

    /**
     * The next sibling of an object is its first following sibling or null if it has no following sibling. 
     * 
     * @return Node
     */
    public function nextSibling()
    {
	
    }

    public function normalize()
    {
	
    }

    /**
     * The cloneNode(deep) method must return a clone of the context object, with the clone children flag set if deep is true. 
     * 
     * @param boolean $deep
     * @return Node
     */
    public function cloneNode($deep = false)
    {
	
    }

    /**
     * 
     * @param \HieuLe\PhpHtmlDom\Node $node
     * @return boolean
     */
    public function isEqualNode(Node $node)
    {
	
    }

    /**
     * The contains(other) method must return true if other is an inclusive descendant of the context object, and false otherwise (including when other is null). 
     * 
     * @param \HieuLe\PhpHtmlDom\Node $node
     * @return boolean
     */
    public function contains(Node $node)
    {
	
    }

    public function compareDocumentPosition(Node $other)
    {
	
    }

    public function insertBefore(Node $node, Node $child)
    {
	
    }

    public function appendChild(Node $node)
    {
	
    }

    public function replaceChild(Node $node, Node $child)
    {
	
    }

    public function removeChild(Node $child)
    {
	
    }
    
    public static function escAttr($input)
    {
	return htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8', false);
    }
    
    public static function escHtml($input)
    {
	return htmlentities($input, ENT_NOQUOTES | ENT_HTML5, 'UTF-8', false);
    }

}

?>
