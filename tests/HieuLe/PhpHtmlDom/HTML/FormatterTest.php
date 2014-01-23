<?php

use HieuLe\PhpHtmlDom\HTML\Formatter;
use HieuLe\PhpHtmlDom\Node\Node;
use HieuLe\PhpHtmlDom\Node\Element;
/**
 * Description of FormatterTest
 *
 * @author TrungHieu
 */
class FormatterTest extends PHPUnit_Framework_TestCase
{
    public function testWriteAttributes()
    {
	$attributes = array();
	$formatter = new Formatter();
	$this->assertEquals("", $formatter->writeAttributes($attributes));
	
	$attributes = array(
	    'class' => 'foo bar',
	    'id' => 'foo-id'
	);
	$this->assertEquals('class="foo bar" id="foo-id"', $formatter->writeAttributes($attributes));
	
	$attributes['alt'] = "<>\"";
	$this->assertEquals('class="foo bar" id="foo-id" alt="&lt;&gt;&quot;"', $formatter->writeAttributes($attributes));
	
	$attributes['alt'] = false;
	$this->assertEquals('class="foo bar" id="foo-id"', $formatter->writeAttributes($attributes));
	
	$attributes['alt'] = true;
	$this->assertEquals('class="foo bar" id="foo-id" alt', $formatter->writeAttributes($attributes));
	
    }
    
    public function testWriteElementOpenningTag()
    {
	$element = new Element('div');
	$formatter = new Formatter();
	$this->assertEquals("<div>", $formatter->writeElementOpenningTag($element));
	
	$element->setAttr('class', 'foo');
	$this->assertEquals("<div class=\"foo\">", $formatter->writeElementOpenningTag($element));
	
	$element = new Element('link');
	$this->assertEquals("<link />", $formatter->writeElementOpenningTag($element));
    }
}

?>
