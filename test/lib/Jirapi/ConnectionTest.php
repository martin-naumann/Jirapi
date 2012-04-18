<?php

namespace Jirapi; require_once dirname(__FILE__) . '/../../bootstrap.php';
class ConnectionTest extends Test {

	protected $_client = null;

	protected function setUp() {
		print "\nConnectionTest::setUp()";
		$config = array(
			'host' => '172.17.18.64',
			'username' => 'admin',
			'password' => 'admin'
		);
		$this->_client = new Client($config);
	}

	public function testSearch() {
		print "\nConnectionTest::testSearch()";
		$jql = 'assignee = admin';
		$params = array();
		$response = $this->_client->search($jql, $params);
		//print_r($response->getData());
	}
}
