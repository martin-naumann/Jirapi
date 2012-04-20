<?php
/**
 * @category Centralway
 * @package  Jirapi
 * @author   Rodrigo Benz
 */
namespace Jirapi\Data; require_once dirname(__FILE__) . '/../../../bootstrap.php';
class ProjectTest extends \Jirapi\Test {

	protected $_client = null;
	protected static $_key = '';

	protected function setUp() {
		print "\nConnectionTest::setUp()";
		$config = array(
			'host' => '192.168.192.44',
		);
		$this->_client = new \Jirapi\Client($config);
	}

	public function testGetAllProjects() {
		// TODO: assertions
		print "\nConnectionTest::testGetAllProjects()";
		$projects = Project::getAllProjectsVisibleToUser();
		//print_r($projects);
	}

	public function testGetProject() {
		// TODO: assertions
		print "\nConnectionTest::testGetProject()";
		$project = new Project(self::$_key, $this->_client);
		//print_r($project->getData());
	}

}
