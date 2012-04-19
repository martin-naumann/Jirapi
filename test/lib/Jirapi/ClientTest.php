<?php
namespace Jirapi; require_once dirname(__FILE__) . '/../../bootstrap.php';

class ClientTest extends Test {

	public function testConstruct() {
		$host = 'localhost';
		$port = 2990;
		$client = new \Jirapi\Client(array(
			'host' => $host,
			'port' => $port
		));

		$this->assertEquals($host, $client->getHost());
		$this->assertEquals($port, $client->getPort());
	}

	// TODO: more tests

}

