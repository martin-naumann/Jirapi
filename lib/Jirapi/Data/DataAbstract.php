<?php
/**
 * @category Centralway
 * @package  Packagename
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; abstract class DataAbstract {

	protected $_client = null;
	protected $_data = array();

	public function __construct($client) {
		$this->_client = $client;
	}

	/**
	 * Static function to create a new Data object
	 * @static
	 * @param $client
	 * @return DataAbstract
	 */
	public static function create($client) {
		return new static($client);
	}

	/**
	 * @return \Jirapi\Client
	 */
	public function getClient() {
		return $this->_client;
	}

	/**
	 * @return \Jirapi\Client
	 */
	public function getData() {
		return $this->_data;
	}

}
