<?php
/**
 * @category Centralway
 * @package  Jirapi
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; class Search extends DataAbstract {

	const PATH = '/rest/api/2/search?';

	protected $_data = array();
	protected $_path = self::PATH;
	protected $_responseString = '';

	/**
	 * @param string $jql
	 * @param array $params
	 */
	public function request($jql, $params) {
		$this->buildPath($jql, $params);
		$data = $this->getClient()->request($this->_path, \Jirapi\Request::GET, array());
		$this->_data = $data;
	}

	/**
	 * Build path for GET request
	 *
	 * @param string $jql
	 * @param array  $params
	 */
	protected function buildPath($jql, $params) {
		$params['jql'] = $jql;
		$this->_path .= http_build_query($params);
	}
}
