<?php
/**
 * Interface for Response classes
 *
 */
namespace Jirapi; class Response {

	protected $_responseString = '';
	protected $_response = null;

	public function __construct($responseString) {
		$this->_responseString = $responseString;
	}

	public function getData() {
		$this->_response = json_decode($this->_responseString);
		return $this->_response;
	}

}
