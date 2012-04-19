<?php

namespace Jirapi; require_once dirname(__FILE__) . '/../../bootstrap.php';
class ConnectionTest extends Test {

	protected $_client = null;

	protected function setUp() {
		print "\nConnectionTest::setUp()";
		$config = array(
			'host' => '192.168.192.44',
			'username' => 'admin',
			'password' => 'admin'
		);
		$this->_client = new Client($config);
	}

	public function testSearch() {
		print "\nConnectionTest::testSearch()";
		$jql = 'assignee = admin';
		$params = array();

		$search = $this->_client->newSearch();
		$search->request($jql, $params);
		print_r($search->getData());
	}
}
