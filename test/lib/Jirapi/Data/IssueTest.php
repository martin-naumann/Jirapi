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
			'host' => '192.168.192.44',
			'username' => 'admin',
			'password' => 'admin'
		);
		$this->_client = new \Jirapi\Client($config);
	}

	public function testCreateIssue() {
		// TODO: assertions
		print "\nConnectionTest::testCreateIssue()";
		$params = array(
			'fields' => array(
				'project' => array('key' => 'CWA'),
				'summary' => 'New ticket!',
				'description' => 'New ticket using Jirapi created',
				'issuetype' => array('id' => '1')
			)
		);
		$issue = Issue::create($params, $this->_client);
		self::$_key = $issue->getData()->key;
		// print_r($issue->getData());
	}

	/**
	 * @depends testCreateIssue
	 */
	public function testGetIssue() {
		// TODO: assertions
		print "\nConnectionTest::testGetIssue()";
		$issue = new Issue(self::$_key, $this->_client);
		print_r($issue->getData());
	}

	/**
	 * @depends testCreateIssue
	 */
	public function testDeleteIssue() {
		// TODO: assertions
		print "\nConnectionTest::testDeleteIssue()";
		$issue = new Issue(self::$_key, $this->_client);
		$issue->delete();
		//print_r($issue->getData());
	}

}
