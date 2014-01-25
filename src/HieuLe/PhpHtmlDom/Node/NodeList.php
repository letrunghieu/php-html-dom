<?php

namespace HieuLe\PhpHtmlDom\Node;

use HieuLe\PhpHtmlDom\Exception\DOMException;

/**
 * A NodeList object is a collection of nodes. 
 *
 * @author TrungHieu
 */
class NodeList implements \IteratorAggregate
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

    /**
     * Return an item at a specified position in the list
     * 
     * @param integer $index
     * @return Node
     * @throws DOMException
     */
    public function item($index)
    {
	if (!is_int($index))
	    throw new DOMException(DOMException::INVALID_ACCESS_ERR, "The index must be an integer");
	if ($index >= count($this->_items))
	    throw new DOMException(DOMException::INDEX_SIZE_ERR, "The index is out of range");
	return $this->_items[$index];
    }

    public function remove($item)
    {
	$position = array_search($item, $this->_items);
	if ($position !== FALSE)
	{
	    array_splice($this->_items, $position, 1);
	    return count($this->_items);
	}
	return FALSE;
    }

    public function contains(Node $node)
    {
	if (array_search($node, $this->_items) !== FALSE)
	    return true;
	else
	{
	    foreach ($this->_items as $item)
		if ($item->contains($node))
		    return true;
	}
	return false;
    }
    
    public function insertBefore(Node $newOne, Node $refOne)
    {
	$position = array_search($refOne, $this->_items);
	if ($position !== FALSE)
	{
	    $this->_items = array_merge(array_slice($this->_items, 0, $position), array($newOne), array_slice($this->_items, $position));
	}
	return FALSE;
    }
    
    public function replace(Node $newOne, Node $oldOne)
    {
	for($i = 0; $i < count($this->_items); $i++)
	{
	    if ($this->_items[$i] == $oldOne)
	    {
		$this->_items[$i] = $newOne;
		return true;
	    }
	}
	return false;
    }

    public function getIterator()
    {
	return new \ArrayIterator($this->_items);
    }

}

?>
