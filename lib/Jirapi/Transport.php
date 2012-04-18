<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rodrigo.benz
 * Date: 16.04.12
 * Time: 15:30
 * To change this template use File | Settings | File Templates.
 */
namespace Jirapi; class Transport {
	protected $_config;
	protected $_data;
	protected $_method;
	protected $_path;

	/**
	 * @var resource Curl resource to reuse
	 */
	protected static $_connection = null;

	/**
	 * @param Request $request Request object
	 */
	public function __construct(Request $request) {
		$this->_request = $request;
	}

	public function exec(array $params) {
		$conn = curl_init();

		$request = $this->getRequest();

		if (!empty($params['url'])) {
			$baseUri = $params['url'];
		} else {
			if (!isset($params['host']) || !isset($params['port'])) {
				throw new Exception\Invalid('host and port have to been set');
			}

			$path = isset($params['path']) ? $params['path'] : '';

			$baseUri = 'http://' . $params['host'] . ':' . $params['port'] . '/' . $path;
		}

		$baseUri .= $request->getPath();

		curl_setopt($conn, CURLOPT_URL, $baseUri);
		curl_setopt($conn, CURLOPT_USERPWD, $params['username'] . ":" . $params['password']);
		curl_setopt($conn, CURLOPT_CUSTOMREQUEST, $request->getMethod());
		curl_setopt($conn, CURLOPT_TIMEOUT, 100);

		$data = $request->getData();
		if (!empty($data)) {
			if (is_array($data)) {
				$content = json_encode($data);
			} else {
				$content = $data;
			}

			// Escaping of / not necessary. Causes problems in base64 encoding of files
			$content = str_replace('\/', '/', $content);

			curl_setopt($conn, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($conn, CURLOPT_POSTFIELDS, $content);
		}

		// cURL opt returntransfer leaks memory, therefore OB instead.
		ob_start();
		curl_exec($conn);
		$responseJson = ob_get_clean();

		// Checks if error exists
		$errorNumber = curl_errno($conn);
		if ($errorNumber > 0) {
			throw new Exception\Client($errorNumber, $request, $responseJson);
		}

		$response = new Response($responseJson);

		return $response->getData();
	}

	/**
	 * @return resource Connection resource
	 */
	protected function _getConnection() {
		if (!self::$_connection) {
			self::$_connection = curl_init();
		}
		return self::$_connection;
	}

	/**
	 * Returns the request object
	 *
	 * @return Request Request object
	 */
	public function getRequest() {
		return $this->_request;
	}

	/**
	 * Called to add additional curl params
	 *
	 * @param resource $connection Curl connection
	 */
	protected function _setupCurl($connection) {
		foreach ($this->_request->getClient()->getConfig('curl') as $key => $param) {
			curl_setopt($connection, $key, $param);
		}
	}
}
