<?php
/**
 * @category Centralway
 * @package  Packagename
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; abstract class DataAbstract {

	protected $_client = null;
	protected $_data = array();

	/**
	 * Create new object and assign a \Jirapi\Client to it
	 * @param \Jirapi\Client $client
	 */
	public function __construct($client) {
		$this->_client = $client;
	}

	/**
	 * Returns the \Jirapi\Client assigned to this object
	 * @return \Jirapi\Client
	 */
	public function getClient() {
		return $this->_client;
	}

	/**
	 * Returns an array holding all data received from jira
	 * @return array
	 */
	public function getData() {
		return $this->_data;
	}

}
