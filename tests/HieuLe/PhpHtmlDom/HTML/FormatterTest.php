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
    
    public function testWriteElementClosingTag()
    {
	$element = new Element('div');
	$formatter = new Formatter();
	$this->assertEquals("</div>", $formatter->writeElementClosingTag($element));
	
	$element = new Element('link');
	$this->assertEquals("", $formatter->writeElementClosingTag($element));
    }
    
    public function testFormatElementNode()
    {
	$formatter = new Formatter();
	
	$div = new Element('div');
	$html= <<<HTML
<div>
</div>

HTML;
	$this->assertEquals($html, $formatter->format($div));
	
	$html= <<<HTML
  <div>
  </div>

HTML;
	$this->assertEquals($html, $formatter->format($div, 1));
	
	$p = new Element('p');
	$p->appendTo($div);
	$br = new Element('br');
	$br->appendTo($div);
	$a = new Element('a');
	$a->appendTo($p);
	$html= <<<HTML
  <div>
    <p>
      <a>
      </a>
    </p>
    <br />
  </div>

HTML;
	$this->assertEquals($html, $formatter->format($div, 1));
    }
}

?>
