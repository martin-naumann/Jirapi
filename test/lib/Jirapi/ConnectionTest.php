<?php

namespace Jirapi; require_once dirname(__FILE__) . '/../../bootstrap.php';
class ConnectionTest extends Test {

	public function testSetup() {
		$config = array(
			'host' => '172.17.18.64',
			'username' => 'admin',
			'password' => 'admin'
		);
		$client = new Client($config);
		$response = $client->getIssue('CWA-1');
		$this->assertNotEquals($response->getData(), array());
	}

}
