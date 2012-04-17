<?php
/**
 * @category Centralway
 * @package  Jirapi
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; class Issue extends DataAbstract {

	const PATH = '/rest/api/2/issue';

	protected $_responseString = '';
	protected $_data = array();

	public function getIssue($issueIdOrKey) {
		$path = self::PATH . '/' . $issueIdOrKey;
		$data = $this->getClient()->request($path, \Jirapi\Request::GET, array());
		$this->_data = $data;
	}
}
