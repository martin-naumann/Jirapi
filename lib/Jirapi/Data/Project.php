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

	public static function getAllVisibleToUser(\Jirapi\Client $client) {
		$response = $client->request(static::PATH, \Jirapi\Request::GET, array());
		$projects = array();

		for ($i = 0; $i < count($response); $i++) {
			$projects[] = $client->getProject($response[$i]->key);
		}

		return $projects;
	}

	public function request($path, $method, $data = array()) {
		$path = static::PATH . '/' . $path;
		return $this->_client->request($path, $method, $data);
	}

}
