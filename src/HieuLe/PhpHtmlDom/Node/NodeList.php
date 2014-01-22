<?php
namespace HieuLe\PhpHtmlDom;
/**
 * A NodeList object is a collection of nodes. 
 *
 * @author TrungHieu
 */
class NodeList
{
    private $_items = array();
    
    public function length()
    {
	return count($this->_items);
    }
    
    /**
     * Adds new elements to the end of this list, and returns the new length
     * 
     * @param \HieuLe\PhpHtmlDom\Node $node
     * @return type
     */
    public function push(Node $node)
    {
	return array_push($this->_items, $node);
    }
    
    /**
     * Removes the last element of this list, and returns that element
     * 
     * @return \HieuLe\PhpHtmlDom\Node
     */
    public function pop()
    {
	return array_pop($this->_items);
    }
    
    /**
     * Removes the first element of this list, and returns that element
     * 
     * @return \HieuLe\PhpHtmlDom\Node
     */
    public function shift()
    {
	return array_shift($this->_items);
    }
    
    /**
     * Adds new elements to the beginning of this list, and returns the new length
     * 
     * @param \HieuLe\PhpHtmlDom\Node $node
     * @return int
     */
    public function unshift(Node $node)
    {
	return array_unshift($this->_items, $node);
    }
    
    public function isEmpty()
    {
	return empty($this->_items);
    }
}

?>
