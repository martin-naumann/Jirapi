<?php
/**
 * @category Centralway
 * @package  Jirapi
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; class Search extends DataAbstract {

	const PATH = '/rest/api/2/search?';

	protected $_data = array();

	//TODO: Expand & refactoring. This class isn't doing much.

	/**
	 * @param string $jql
	 * @param array  $params
	 */
	public function request($jql, $params) {
		$path = $this->buildPath($jql, $params);
		$data = $this->getClient()->request($path, \Jirapi\Request::GET, array());
		$this->_data = $data;
	}

	/**
	 * Build path for GET request
	 *
	 * @param string $jql
	 * @param array  $params
	 * @return string
	 */
	protected function buildPath($jql, $params) {
		$params['jql'] = $jql;
		return static::PATH . http_build_query($params);
	}
}
