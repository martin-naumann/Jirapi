<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rodrigo.benz
 * Date: 16.04.12
 * Time: 17:07
 * To change this template use File | Settings | File Templates.
 */
class Jirapi_ConnectionTest extends Jirapi_Test {

	public function testSetup() {
		$config= array(
			'url' => 'https://jira.atlassian.com',
		);
		$client = new Jirapi_Client($config);
		$response = $client->getIssue('JRA-9');
		print_r($response);
	}

}
