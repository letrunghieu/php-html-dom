<?php

namespace HieuLe\PhpHtmlDom\HTML;

use HieuLe\PhpHtmlDom\Node\Node;
use HieuLe\PhpHtmlDom\Node\Element;

/**
 * Format HTML node tree
 *
 * @author TrungHieu
 */
class Formatter
{

    public $ommitClosableTags = false;
    public $indentString = "  ";
    public $newlineChar = PHP_EOL;

    /**
     * Contruct the list of all attributes and their value in the format <code>attribute="value"</code>
     * 
     * @param array $attrs
     * @return string
     */
    public function writeAttributes(array $attrs)
    {
	$attrPairs = array();
	foreach ($attrs as $attr => $value)
	{
	    if ($value === TRUE)
	    {
		$attrPairs[] = "{$attr}";
	    } else if ($value !== FALSE && $value !== NULL)
	    {
		$val = htmlspecialchars($value, ENT_COMPAT | ENT_HTML5, 'UTF-8', false);
		$attrPairs[] = "{$attr}=\"{$val}\"";
	    }
	}
	return implode(" ", $attrPairs);
    }

    /**
     * Write the start tag of an element
     * @link http://www.w3.org/TR/html5/syntax.html#start-tags
     * 
     * @param \HieuLe\PhpHtmlDom\Node\Element $element
     * @return string
     */
    public function writeElementOpenningTag(Element $element)
    {
	$startTag = "<{$element->getTagName()}";
	$attr = $this->writeAttributes($element->getAttrs());
	if ($attr !== "")
	    $startTag .= " {$attr}";
	if ($element->isSelfClosing())
	    $startTag .= " /";
	$startTag .= ">";
	return $startTag;
    }

    /**
     * Write element closing tag
     * @link http://www.w3.org/TR/html5/syntax.html#end-tags 
     * 
     * @param \HieuLe\PhpHtmlDom\Node\Element $element
     * @return string
     */
    public function writeElementClosingTag(Element $element)
    {
	if ($element->isSelfClosing())
	    return "";
	return "</{$element->getTagName()}>";
    }

    public function format(Node $node, $depth = 0)
    {
	// write the element node
	if ($node->getNodeType() == Node::ELEMENT_NODE)
	{
	    return $this->_formatElement($node, $depth);
	}
	// @todo write other types of node
    }

    private function _formatElement(Node $node, $depth)
    {
	$openTag = $this->writeElementOpenningTag($node);
	$content = "";
	foreach ($node->children() as $n)
	{
	    $content .= $this->format($n, $depth + 1);
	}
	$closeTag = $this->writeElementClosingTag($node);
	$indexText = $this->_writeIndent($depth);
	$tag = "{$indexText}{$openTag}{$this->newlineChar}{$content}";
	if ($closeTag)
	    $tag .= "{$indexText}{$closeTag}{$this->newlineChar}";
	return $tag;
    }

    private function _writeIndent($depth)
    {
	return str_repeat($this->indentString, $depth);
    }

}

?>
