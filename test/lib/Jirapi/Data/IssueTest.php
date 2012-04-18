<?php
/**
 * @category Centralway
 * @package  Packagename
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; require_once dirname(__FILE__) . '/../../../bootstrap.php';
class ConnectionTest extends \Jirapi\Test {

	protected $_client = null;

	protected function setUp() {
		print "\nConnectionTest::setUp()";
		$config = array(
			'host' => '172.17.18.64',
			'username' => 'admin',
			'password' => 'admin'
		);
		$this->_client = new \Jirapi\Client($config);
	}

	public function testGetIssue() {
		print "\nConnectionTest::testGetIssue()";
		$issue = Issue::create($this->_client);
		$issue->getIssue('CWA-1');
		//print_r($issue->getLastResponse());
	}

	public function testPostIssue() {
		print "\nConnectionTest::testPostIssue()";
		$params = array(
			'fields' => array(
				'project' => array('key' => 'CWA'),
				'summary' => 'New ticket!',
				'description' => 'New ticket using Jirapi created',
				'issuetype' => array('id' => '1')
			)
		);
		$issue = Issue::create($this->_client);
		$issue->postIssue($params);
		print_r($issue->getLastResponse());
	}

}
