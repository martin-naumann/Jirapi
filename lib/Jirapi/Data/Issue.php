<?php
/**
 * @category Centralway
 * @package  Jirapi
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; class Issue extends DataAbstract {

	const PATH = '/rest/api/2/issue';

	protected $_data = array();
	protected $_lastResponse = array();
	protected $_params = array();

	public function getIssue($issueIdOrKey) {
		$path = self::PATH . '/' . $issueIdOrKey;
		$data = $this->getClient()->request($path, \Jirapi\Request::GET, array());
		$this->_data = $data;
		$this->_lastResponse = $data;
	}

	public function getLastResponse() {
		return $this->_lastResponse;
	}

	public function createIssue($params = array()) {
		// use $params
		if (isset($params)) {
			$this->_params = $params;
		}
		$data = $this->getClient()->request(self::PATH, \Jirapi\Request::POST, $this->_params);
		$this->_lastResponse = $data;
	}

	public function deleteIssue($issueIdOrKey) {
		// TODO: set deleteSubtasks parameter
		$path = self::PATH . '/' . $issueIdOrKey;
		$data = $this->getClient()->request($path, \Jirapi\Request::DELETE, array());
		$this->_data = $data;
		$this->_lastResponse = $data;
	}
}
