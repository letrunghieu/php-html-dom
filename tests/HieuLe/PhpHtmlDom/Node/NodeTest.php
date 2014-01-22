<?php

use HieuLe\PhpHtmlDom\Node\Node;
use HieuLe\PhpHtmlDom\Node\NodeList;


/**
 * Description of NodeTest
 *
 * @author TrungHieu
 */
class NodeTest extends PHPUnit_Framework_TestCase
{
    public function testChildren()
    {
	$node = new Node();
	
	$this->assertFalse($node->hasChildNodes());
    }
    
    public function testAppend()
    {
	$parent = new Node();
	$child = new Node();
	$parent->append($child);
	$this->assertTrue($parent->hasChildNodes());
	
	$this->assertSame($parent, $child->getParent());
	$this->assertSame($child, $parent->children(0));
	
	$child2 = new Node();
	$parent->append($child2);
	$this->assertSame($parent, $child->getParent());
	$this->assertSame($child, $parent->children(0));
	$this->assertSame($child2, $parent->children(1));
	
	$parent->append($child);
	$this->assertSame($child, $parent->children(0));
	$this->assertSame($child, $parent->children(2));
    }
    
    /**
     * @expectedException HieuLe\PhpHtmlDom\Exception\DOMException
     */
    public function testAppendItself()
    {
	$parent = new Node();
	$parent->append($parent);
    }
}

?>
