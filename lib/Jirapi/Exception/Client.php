<?php
/**
 * @category Centralway
 * @package  Jirapi
 * @author   Rodrigo Benz
 */
namespace Jirapi\Exception; class Client extends ExceptionAbstract {

	protected $_error = 0;
	protected $_request = null;
	protected $_response = null;

	/**
	 * @param string					  $error Error
	 * @param \Jirapi\Request			 $request
	 * @param \Jirapi\Response			$response
	 */
	public function __construct($error, \Jirapi\Request $request = null) {
		$this->_error = $error;
		$this->_request = $request;

		$message = $this->getErrorMessage($this->getError());
		parent::__construct($message);
	}

	/**
	 * Returns the error message corresponding to the error code
	 * cUrl error code reference can be found here {@link http://curl.haxx.se/libcurl/c/libcurl-errors.html}
	 *
	 * @param string $error Error code
	 * @return string Error message
	 */
	public function getErrorMessage($error) {

		switch ($error) {
			case CURLE_UNSUPPORTED_PROTOCOL:
				$error = "Unsupported protocol";
				break;
			case CURLE_FAILED_INIT:
				$error = "Internal cUrl error?";
				break;
			case CURLE_URL_MALFORMAT:
				$error = "Malformed URL";
				break;
			case CURLE_COULDNT_RESOLVE_PROXY:
				$error = "Couldn't resolve proxy";
				break;
			case CURLE_COULDNT_RESOLVE_HOST:
				$error = "Couldn't resolve host";
				break;
			case CURLE_COULDNT_CONNECT:
				$error = "Couldn't connect to host";
				break;
			case 28:
				$error = "Operation timed out";
				break;
			default:
				$error = "Unknown error:" . $error;
				break;
		}

		return $error;
	}

	/**
	 * @return string Error code / message
	 */
	public function getError() {
		return $this->_error;
	}

	/**
	 * Returns request object
	 *
	 * @return \Jirapi\Request Request object
	 */
	public function getRequest() {
		return $this->_request;
	}

	/**
	 * Returns response object
	 *
	 * @return \Jirapi\Response Response object
	 */
	public function getResponse() {
		return $this->_response;
	}

}
