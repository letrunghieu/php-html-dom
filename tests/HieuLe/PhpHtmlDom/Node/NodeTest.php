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
	$parent->appendChild($child);
	$this->assertTrue($parent->hasChildNodes());
	
	$this->assertSame($parent, $child->getParent());
	$this->assertSame($child, $parent->children(0));
	
	$child2 = new Node();
	$parent->appendChild($child2);
	$this->assertSame($parent, $child->getParent());
	$this->assertSame($child, $parent->children(0));
	$this->assertSame($child2, $parent->children(1));
	
	$parent->appendChild($child);
	$this->assertSame($child, $parent->children(0));
	$this->assertSame($child, $parent->children(2));
    }
    
    /**
     * @expectedException HieuLe\PhpHtmlDom\Exception\DOMException
     */
    public function testAppendItself()
    {
	$parent = new Node();
	$parent->appendChild($parent);
    }
    
    public function testAppendTo()
    {
	$parent = new Node();
	$child = new Node();
	$child->appendTo($parent);
	$this->assertTrue($parent->hasChildNodes());
	
	$this->assertSame($parent, $child->getParent());
	$this->assertSame($child, $parent->children(0));
	
	$child2 = new Node();
	$child2->appendTo($parent);
	$this->assertSame($parent, $child->getParent());
	$this->assertSame($child, $parent->children(0));
	$this->assertSame($child2, $parent->children(1));
	
	$child->appendTo($parent);
	$this->assertSame($child, $parent->children(0));
	$this->assertSame($child, $parent->children(2));
    }
    
    public function testRemoveChild()
    {
	$parent = new Node();
	$child = new Node();
	$child->appendTo($parent);
	$parent->removeChild($child);
	$this->assertNull($child->getParent());
	$this->assertTrue($parent->children()->isEmpty());
    }
    
    /**
     * @expectedException \HieuLe\PhpHtmlDom\Exception\DOMException
     */
    public function testRemoveChildNotFound()
    {
	$parent = new Node();
	$node = new Node();
	$parent2 = new Node();
	$node->appendTo($parent);
	$parent2->removeChild($node);
    }
    
    /**
     * @expectedException \HieuLe\PhpHtmlDom\Exception\DOMException
     */
    public function testRemoveChildException()
    {
	$parent = new Node();
	$child = new Node();
	$parent->removeChild($child);
    }
    
    public function testContains()
    {
	$parent = new Node();
	$child = new Node();
	$child2 = new Node();
	$nephew = new Node();
	$nephew->appendTo($child);
	$parent->appendChild($child)->appendChild($child2);
	$this->assertTrue($parent->contains($parent));
	$this->assertTrue($parent->contains($child));
	$this->assertTrue($parent->contains($child2));
	$this->assertTrue($parent->contains($nephew));
	$this->assertFalse($child2->contains($nephew));
    }
    
    public function testReplaceChild()
    {
	$parent = new Node();
	$child = new Node();
	$child2 = new Node();
	$node = new Node();
	
	
	$parent->appendChild($child)->appendChild($child2);
	$parent->replaceChild($node, $child);
	
	$this->assertSame($node, $parent->children(0));
    }
    
    /**
     * @expectedException \HieuLe\PhpHtmlDom\Exception\DOMException
     */
    public function testReplaceChildNotFound()
    {
	$parent = new Node();
	$child = new Node();
	$child2 = new Node();
	$node = new Node();
	
	
	$parent->appendChild($child)->appendChild($child2);
	$parent->replaceChild($child2, $node);
    }
    
    /**
     * @expectedException \HieuLe\PhpHtmlDom\Exception\DOMException
     */
    public function testReplaceChildExceptionHierachy()
    {
	$parent = new Node();
	$child = new Node();
	$child2 = new Node();
	$node = new Node();
	
	
	$parent->appendChild($child)->appendChild($child2)->appendTo($node);
	$parent->replaceChild($node, $child);
    }
    
    public function testInsertBefore()
    {
	$parent = new Node();
	$child = new Node();
	$newChild = new Node();
	
	$parent->appendChild($child)->insertBefore($newChild, $child);
	$this->assertSame($newChild, $parent->children(0));
	
	$lastChild = new Node();
	$parent->insertBefore($lastChild);
	$this->assertSame($parent->children(2), $lastChild);
	
    }
}

?>
