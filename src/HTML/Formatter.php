<?php

namespace HieuLe\PhpHtmlDom\HTML;

use HieuLe\PhpHtmlDom\Node\Node;
use HieuLe\PhpHtmlDom\Node\Element;
use HieuLe\PhpHtmlDom\Node\Text;

/**
 * Format HTML node tree
 *
 * @author TrungHieu
 */
class Formatter
{

    public $ommitClosableTags = false;
    public $indentString      = "  ";
    public $newlineChar       = PHP_EOL;
    public $customFormatRules = array(
        'textarea' => array('format_inside' => false),
    );

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
            }
            else if ($value !== FALSE && $value !== NULL)
            {
                $val         = htmlspecialchars($value, ENT_COMPAT, 'UTF-8', false);
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
        $attr     = $this->writeAttributes($element->getAttrs());
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

    public function format(Node $node, $depth = 0, $allowFormat = true)
    {
        // write the element node
        if ($node->getNodeType() == Node::ELEMENT_NODE)
        {
            return $this->_formatElement($node, $depth, $allowFormat);
        }
        else if ($node->getNodeType() == Node::TEXT_NODE)
        {
            return $this->_formatText($node, $depth, $allowFormat);
        }
        // @todo write other types of node
    }

    private function _formatElement(Element $node, $depth, $allowFormat)
    {
        $openTag     = $this->writeElementOpenningTag($node);
        $content     = "";
        $insideDepth = $depth + 1;
        foreach ($node->children() as $n)
        {
            if (isset($this->customFormatRules[$node->getTagName()]) && isset($this->customFormatRules[$node->getTagName()]['format_inside']) && !$this->customFormatRules[$node->getTagName()]['format_inside'])
                $content .= $this->format($n, 0, false);
            else
                $content .= $this->format($n, $insideDepth);
        }
        $closeTag       = $this->writeElementClosingTag($node);
        $indexText      = $this->_writeIndent($depth);
        $afterOpenTag   = $this->newlineChar;
        if ($content == "" || (isset($this->customFormatRules[$node->getTagName()]) && isset($this->customFormatRules[$node->getTagName()]['format_inside']) && !$this->customFormatRules[$node->getTagName()]['format_inside']))
            $afterOpenTag   = "";
        if ($node->isSelfClosing())
            $afterOpenTag   = $this->newlineChar;
        $beforeCloseTag = $indexText;
        if ($content == "" || (isset($this->customFormatRules[$node->getTagName()]) && isset($this->customFormatRules[$node->getTagName()]['format_inside']) && !$this->customFormatRules[$node->getTagName()]['format_inside']))
            $beforeCloseTag = "";
        $tag            = "{$indexText}{$openTag}{$afterOpenTag}{$content}";
        if ($closeTag)
            $tag .= "{$beforeCloseTag}{$closeTag}{$this->newlineChar}";
        return $tag;
    }

    private function _formatText(Text $node, $depth, $allowFormat)
    {
        $beforeText = "";
        if ($allowFormat)
            $beforeText = $this->_writeIndent($depth);
        $afterText  = "";
        if ($allowFormat)
            $afterText  = $this->newlineChar;
        return "{$beforeText}{$node->html()}{$afterText}";
    }

    private function _writeIndent($depth)
    {
        return str_repeat($this->indentString, $depth);
    }

}

?>
