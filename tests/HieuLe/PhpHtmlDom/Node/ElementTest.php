<?php

use HieuLe\PhpHtmlDom\Node\Element;
use HieuLe\PhpHtmlDom\Node\Node;
use HieuLe\PhpHtmlDom\Exception\DOMException;

/**
 * Description of ElementTest
 *
 * @author TrungHieu
 */
class ElementTest extends PHPUnit_Framework_TestCase
{

    public function testCreateElement()
    {
	$element = new Element('div');

	$this->assertInstanceOf('\HieuLe\PhpHtmlDom\Node\Node', $element);
	$this->assertEquals('div', $element->getTagName());
	$this->assertSame(array(), $element->getAttrs());
    }

    public function testSetAttribute()
    {
	$element = new Element('div');

	$element->setAttr('class', 'foo');
	$attrs = $element->getAttrs();
	$this->assertArrayHasKey('class', $attrs);
	$this->assertSame('foo', $attrs['class']);

	$element->setAttr('class', 'bar');
	$attrs = $element->getAttrs();
	$this->assertSame('bar', $attrs['class']);

	$element->setAttr('class', 'foo')->setAttr('id', 'bar');
	$attrs = $element->getAttrs();
	$this->assertSame('foo', $attrs['class']);
	$this->assertSame('bar', $attrs['id']);

	$element->setAttr('class');
	$attrs = $element->getAttrs();
	$this->assertArrayNotHasKey('class', $attrs);

	try
	{
	    $element->setAttr('id x');
	} catch (\Exception $e)
	{
	    $this->assertInstanceOf('HieuLe\PhpHtmlDom\Exception\DOMException', $e);
	    return;
	}
	$this->fail('Need to thrown DOMException');
    }

    public function testGetAttribute()
    {
	$element = new Element('div');

	$this->assertNull($element->getAttr('class'));

	$element->setAttr('class', 'foo');
	$this->assertSame('foo', $element->getAttr('class'));

	$element->setAttr('class', 'bar');
	$this->assertSame('bar', $element->getAttr('class'));

	$element->setAttr('class', 'foo')->setAttr('id', 'bar');
	$this->assertSame('foo', $element->getAttr('class'));
	$this->assertSame('bar', $element->getAttr('id'));

	$element->setAttr('class');
	$this->assertNull($element->getAttr('class'));

	try
	{
	    $element->setAttr('id x');
	} catch (\Exception $e)
	{
	    $this->assertInstanceOf('HieuLe\PhpHtmlDom\Exception\DOMException', $e);
	    $this->assertSame('bar', $element->getAttr('id'));
	    return;
	}
	$this->fail('Need to thrown DOMException');
    }

    public function testAddClass()
    {
	$element = new Element('div');
	$element->addClass('foo');
	$this->assertSame('foo', $element->getAttr('class'));

	$element->addClass('bar');
	$this->assertSame('foo bar', $element->getAttr('class'));

	$element->addClass('class1 class2');
	$this->assertSame('foo bar class1 class2', $element->getAttr('class'));

	$element->addClass('foo');
	$this->assertSame('foo bar class1 class2', $element->getAttr('class'));

	$element->addClass('cl')->setAttr('class', 'new-class');
	$this->assertSame('new-class', $element->getAttr('class'));
    }

    public function testHasClass()
    {
	$element = new Element('div');
	$this->assertFalse($element->hasClass('foo'));

	$element->addClass('foo');
	$this->assertTrue($element->hasClass('foo'));

	$element->addClass('bar');
	$this->assertTrue($element->hasClass('bar'));
    }

    public function testRemoveClass()
    {
	$element = new Element('div');
	$element->addClass('foo bar new-class')->removeClass('foo');

	$this->assertFalse($element->hasClass('foo'));
	$this->assertTrue($element->hasClass('bar'));

	$element->removeClass('bar new-class foo');
	$this->assertNull($element->getAttr('class'));
    }

    public function testAppendText()
    {
	$element = new Element('div');
	$text = 'Foo';
	$element->appendText($text);
	$html = <<<HTML
<div>
  Foo
</div>

HTML;
	$this->assertSame($html, $element->html());
    }

}

?>
