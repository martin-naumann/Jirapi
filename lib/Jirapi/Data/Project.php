<?php
/**
 * @category Centralway
 * @package  Jirapi
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; class Project extends DataAbstract {

	const PATH = '/rest/api/2/project';

	protected $_key = '';

	public function __construct($key, \Jirapi\Client $client) {
		parent::__construct($client);
		$this->_key = $key;
		$this->_data = $this->request($key, \Jirapi\Request::GET, array());
	}

	public function request($path, $method, $data = array()) {
		$path = self::PATH . '/' . $path;
		return $this->_client->request($path, $method, $data);
	}

}
