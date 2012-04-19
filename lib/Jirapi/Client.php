<?php
/**
 * Class for main interaction
 */
namespace Jirapi; class Client {

	/**
	 * Default jira port
	 */
	const DEFAULT_PORT = 2990;

	/**
	 * Default host
	 */
	const DEFAULT_HOST = 'localhost';

	const DEFAULT_PATH = 'jira';

	/**
	 * Default timeout
	 */
	const TIMEOUT = 50;

	/**
	 * Config with defaults
	 *
	 * @var array
	 */
	protected $_config = array(
		'host' => self::DEFAULT_HOST,
		'port' => self::DEFAULT_PORT,
		'path' => self::DEFAULT_PATH,
		'url' => null,
		'username' => '',
		'password' => '',
		'timeout' => self::TIMEOUT,
		'headers' => array(),
		'curl' => array(),
		'log' => false,
	);

	/**
	 * @param array $config
	 */
	public function __construct(array $config = array()) {
		$this->setConfig($config);
	}

	/**
	 * @param array $config
	 * @return Client
	 */
	public function setConfig(array $config) {
		foreach ($config as $key => $value) {
			$this->_config[$key] = $value;
		}

		return $this;
	}

	/**
	 * Returns a specific config key or the whole
	 * config array if not set
	 *
	 * @param string $key Config key
	 * @return array|string Config value
	 */
	public function getConfig($key = '') {
		if (empty($key)) {
			return $this->_config;
		}

		if (!array_key_exists($key, $this->_config)) {
			throw new Exception\Invalid('Config key is not set: ' . $key);
		}

		return $this->_config[$key];
	}

	/**
	 * Returns host the client connects to
	 *
	 * @return string Host
	 */
	public function getHost() {
		return $this->getConfig('host');
	}

	/**
	 * Returns connection port of this client
	 *
	 * @return int Connection port
	 */
	public function getPort() {
		return (int) $this->getConfig('port');
	}

	/**
	 * @param $issueIdOrKey
	 * @return Data\Issue
	 */
	public function getIssue($issueIdOrKey) {
		return new Data\Issue($issueIdOrKey, $this);
	}

	/**
	 * @param array $params
	 * @return Data\Issue
	 */
	public function createIssue($params = array()) {
		return Data\Issue::create($params, $this);
	}

	/**
	 * @param	   $path
	 * @param	   $method
	 * @param array $data
	 * @return mixed
	 */
	public function request($path, $method, $data = array()) {
		$request = new Request($this, $path, $method, $data);
		return $request->send();
	}

	/**
	 * Searches for issues using JQL.
	 *
	 * @param string $sql
	 * @param array  $params
	 * @return Data\Search
	 */
	public function search($sql, $params) {
		return new Data\Search($sql, $params, $this);
	}
}
