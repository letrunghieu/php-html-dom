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

    public function format(Node $node)
    {
	
    }

}

?>
