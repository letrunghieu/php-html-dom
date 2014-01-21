<?php

namespace HieuLe\PhpHtmlDom\Exception;

/**
 * A common DOMException
 * @link http://dom.spec.whatwg.org/#domexception DOM specification
 *
 * @author TrungHieu
 */
class DOMException extends \Exception
{
    /**
     * The index is not in the allowed range. 
     */

    const INDEX_SIZE_ERR = 1;

    /**
     * 	The operation would yield an incorrect node tree. 
     */
    const HIERARCHY_REQUEST_ERR = 3;

    /**
     * The object is in the wrong document. 
     */
    const WRONG_DOCUMENT_ERR = 4;

    /**
     * 	The string contains invalid characters.
     */
    const INVALID_CHARACTER_ERR = 5;

    /**
     * The object can not be modified. 
     */
    const NO_MODIFICATION_ALLOWED_ERR = 7;

    /**
     * The object can not be found here. 
     */
    const NOT_FOUND_ERR = 8;

    /**
     * The operation is not supported. 
     */
    const NOT_SUPPORTED_ERR = 9;

    /**
     * The object is in an invalid state. 
     */
    const INVALID_STATE_ERR = 11;

    /**
     * The string did not match the expected pattern. 
     */
    const SYNTAX_ERR = 12;

    /**
     * The object can not be modified in this way. 
     */
    const INVALID_MODIFICATION_ERR = 13;

    /**
     * The operation is not allowed by Namespaces in XML.
     */
    const NAMESPACE_ERR = 14;

    /**
     * The object does not support the operation or argument. 
     */
    const INVALID_ACCESS_ERR = 15;

    /**
     * The operation is insecure. 
     */
    const SECURITY_ERR = 18;

    /**
     * A network error occurred. 
     */
    const NETWORK_ERR = 19;

    /**
     * The operation was aborted. 
     */
    const ABORT_ERR = 20;

    /**
     * The given URL does not match another URL. 
     */
    const URL_MISMATCH_ERR = 21;

    /**
     * The quota has been exceeded. 
     */
    const QUOTA_EXCEEDED_ERR = 22;

    /**
     * The operation timed out. 
     */
    const TIMEOUT_ERR = 23;

    /**
     * The supplied node is incorrect or has an incorrect ancestor for this operation. 
     */
    const INVALID_NODE_TYPE_ERR = 24;

    /**
     * The object can not be cloned. 
     */
    const DATA_CLONE_ERR = 25;

    private $_name;
    private static $_nameTable = array(
	static::INDEX_SIZE_ERR => "IndexSizeError",
	static::HIERARCHY_REQUEST_ERR => "HierarchyRequestError",
	static::WRONG_DOCUMENT_ERR => "WrongDocumentError",
	static::INVALID_CHARACTER_ERR => "InvalidCharacterError",
	static::NO_MODIFICATION_ALLOWED_ERR => "NoModificationAllowedError",
	static::NOT_FOUND_ERR => "NotFoundError",
	static::NOT_SUPPORTED_ERR => "NotSupportedError",
	static::INVALID_STATE_ERR => "InvalidStateError",
	static::SYNTAX_ERR => "SyntaxError",
	static::INVALID_MODIFICATION_ERR => "InvalidModificationError",
	static::NAMESPACE_ERR => "NamespaceError",
	static::INVALID_ACCESS_ERR => "InvalidAccessError",
	static::SECURITY_ERR => "SecurityError",
	static::NETWORK_ERR => "NetworkError",
	static::ABORT_ERR => "AbortError",
	static::URL_MISMATCH_ERR => "URLMismatchError",
	static::QUOTA_EXCEEDED_ERR => "QuotaExceededError",
	static::TIMEOUT_ERR => "TimeoutError",
	static::INVALID_NODE_TYPE_ERR => "InvalidNodeTypeError",
	static::DATA_CLONE_ERR => "DataCloneError",
    );

    public function __construct($code, $message)
    {
	parent::__construct($message, $code);
	if (isset(static::$_nameTable[$code]))
	{
	    $this->_name = static::$_nameTable[$code];
	}
	else
	    $this->_name = "DOMError";
    }
    
    public function getName()
    {
	return $this->_name;
    }

}

?>
