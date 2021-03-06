<?php
/**
 * @category Centralway
 * @package  Jirapi
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; class Issue extends DataAbstract {

	const PATH = '/rest/api/2/issue';

	protected $_idOrKey = '';

	public function __construct($issueIdOrKey, $client) {
		parent::__construct($client);
		$this->_idOrKey = $issueIdOrKey;
		$path = static::PATH . '/' . $this->_idOrKey;
		$this->_data = $this->request($path, \Jirapi\Request::GET, array());
	}

	/**
	 * Creates an issue from a JSON or array representation.
	 *
	 * @static
	 * @param array $params issue representation
	 * @param \Jirapi\Client $client
	 * @return Issue
	 */
	public static function create($params = array(), \Jirapi\Client $client) {
		$data = $client->request(static::PATH, \Jirapi\Request::POST, $params);
		return new static($data->key, $client);
	}

	public function delete() {
		// TODO: boolean for subIssues
		$path = static::PATH . '/' . $this->_idOrKey;
		$this->request($path, \Jirapi\Request::DELETE, array());
	}

	/**
	 *
	 *
	 * @param $path
	 * @param $method
	 * @param $data
	 * @return mixed
	 */
	public function request($path, $method, $data) {
		return $this->getClient()->request($path, $method, $data);
	}
}
