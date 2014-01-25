<?php
namespace HieuLe\PhpHtmlDom\Node;
/**
 * Description of Text
 *
 * @author TrungHieu
 */
class Text extends Node
{
    private $_text;
    
    public function __construct($text = "")
    {
	parent::__construct();
	$this->_text = $text;
	$this->_nodeType = Node::TEXT_NODE;
    }
    
    /**
     * Return the text content of this element
     * 
     * @return string
     */
    public function html($formatter = null)
    {
	return $this->_text;
    }
    
    /**
     * Set the text content of this element to a new value;
     * 
     * @param type $text
     * @return \HieuLe\PhpHtmlDom\Node\Text
     */
    public function setText($text)
    {
	$this->_text = $text;
	return $this;
    }
}

?>
