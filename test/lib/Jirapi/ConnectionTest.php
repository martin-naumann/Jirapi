<?php

namespace Jirapi; require_once dirname(__FILE__) . '/../../bootstrap.php';
class ConnectionTest extends Test {

	public function testSetup() {
		$config = array(
			'url' => 'https://centralway.atlassian.com'
		);
		$client = new Client($config);
		$response = $client->getIssue('JRA-9');
		print_r($response);
	}

}
