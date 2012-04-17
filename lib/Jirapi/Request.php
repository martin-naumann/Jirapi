<?php
/**
 * Connection management
 */
namespace Jirapi; class Request {

	const POST = 'POST';
	const PUT = 'PUT';
	const GET = 'GET';
	const DELETE = 'DELETE';

	protected $_client;
	protected $_path;
	protected $_method;
	protected $_data;

	public function __construct(Client $client, $path, $method, $data = array()) {
		$this->_client = $client;
		$this->_path = $path;
		$this->_method = $method;
		$this->_data = $data;
	}

	/**
	 * Sets the request method. Use one of the four consts
	 *
	 * @param string $method Request method
	 * @return Request Current object
	 */
	public function setMethod($method) {
		$this->_method = $method;
		return $this;
	}

	/**
	 * @return string Request method
	 */
	public function getMethod() {
		return $this->_method;
	}

	/**
	 * Sets the request data
	 *
	 * @param array $data Request data
	 * @return Request Current object
	 */
	public function setData($data) {
		$this->_data = $data;
		return $this;
	}

	/**
	 * @return array Request data
	 */
	public function getData() {
		return $this->_data;
	}

	/**
	 * Sets the request path
	 *
	 * @param string $path Request path
	 * @return Request Current object
	 */
	public function setPath($path) {
		$this->_path = $path;
		return $this;
	}

	/**
	 * @return string Request path
	 */
	public function getPath() {
		return $this->_path;
	}

	/**
	 * @return Client
	 */
	public function getClient() {
		return $this->_client;
	}

	/**
	 * Returns a specific config key or the whole
	 * config array if not set
	 *
	 * @param string $key Config key
	 * @return array|string Config value
	 */
	public function getConfig($key = '') {
		return $this->getClient()->getConfig($key);
	}

	/**
	 * Sends request to server
	 *
	 * @return string Response string
	 */
	public function send() {

		$transport = new Transport($this);

		$params = array(
			'url' => $this->getClient()->getConfig('url'),
			'host' => $this->getClient()->getHost(),
			'port' => $this->getClient()->getPort(),
			'path' => $this->getClient()->getPath(),
			'username' => $this->getClient()->getConfig('username'),
			'password' => $this->getClient()->getConfig('password')
		);
		$response = $transport->exec($params);
		return $response;
	}
}
