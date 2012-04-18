<?php
/**
 * @category Centralway
 * @package  Packagename
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; require_once dirname(__FILE__) . '/../../../bootstrap.php';
class ConnectionTest extends \Jirapi\Test {

	protected $_client = null;
	protected static $_key = '';

	protected function setUp() {
		print "\nConnectionTest::setUp()";
		$config = array(
			'host' => '172.17.18.64',
			'username' => 'admin',
			'password' => 'admin'
		);
		$this->_client = new \Jirapi\Client($config);
	}

	public function testCreateIssue() {
		print "\nConnectionTest::testCreateIssue()";
		$params = array(
			'fields' => array(
				'project' => array('key' => 'CWA'),
				'summary' => 'New ticket!',
				'description' => 'New ticket using Jirapi created',
				'issuetype' => array('id' => '1')
			)
		);
		$issue = Issue::create($this->_client);
		$issue->createIssue($params);
		self::$_key = $issue->getLastResponse()->key;
		// print_r($issue->getLastResponse());
	}

	/**
	 * @depends testCreateIssue
	 */
	public function testGetIssue() {
		print "\nConnectionTest::testGetIssue()";
		$issue = Issue::create($this->_client);
		$issue->getIssue(self::$_key);
		//print_r($issue->getLastResponse());
	}

	/**
	 * @depends testCreateIssue
	 */
	public function testDeleteIssue() {
		print "\nConnectionTest::testDeleteIssue()";
		$issue = Issue::create(($this->_client));
		$issue->deleteIssue(self::$_key);
		print_r($issue->getLastResponse());
	}

}
