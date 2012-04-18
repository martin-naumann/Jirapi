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

	public function testSetup() {
		print "\nConnectionTest::testSetup()";
		$response = $this->_client->getIssue('CWA-1');
		//print_r($response->getData());
	}

	public function testSearch() {
		print "\nConnectionTest::testSearch()";
		$jql = 'assignee = admin';
		$params = array();
		$response = $this->_client->search($jql, $params);
		//print_r($response->getData());
	}

	public function testIssue() {
		print "\nConnectionTest::testIssue()";
		$params = array(
			'fields' => array(
				'project' => array('key' => 'CWA'),
				'summary' => 'New ticket!',
				'description' => 'New ticket using Jirapi created',
				'issuetype' => array('id' => '1')
			)
		);
		$issue = Data\Issue::create($this->_client);
		$issue->postIssue($params);
		print_r($issue->getLastResponse());
	}
}
