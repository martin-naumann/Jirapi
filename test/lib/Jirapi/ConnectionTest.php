<?php

namespace Jirapi; require_once dirname(__FILE__) . '/../../bootstrap.php';
class ConnectionTest extends Test {

	protected $_client = null;

	protected function setUp() {
		$config = array(
			'host' => '172.17.18.64',
			'username' => 'admin',
			'password' => 'admin'
		);
		$this->_client = new Client($config);
	}

	public function testSetup() {
		$response = $this->_client->getIssue('CWA-1');
	}

	public function testSearch() {
		$jql = 'assignee = admin';
		$params = array();
		$response = $this->_client->search($jql, $params);
	}
}
