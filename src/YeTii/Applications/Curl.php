<?php
namespace YeTii\Applications;

use YeTii\General\Str;

class Curl {

	private $url = '';
	private $method = 'GET';
	private $methods_available = array('POST','GET','PUT','DELETE','PATCH','OPTIONS');
	private $data = [];
	private $timeout = 30;
	private $returntransfer = TRUE;
	private $encoding = '';
	private $maxredirs = 10;
	private $ssl_verifyhost = FALSE;
	private $ssl_verifypeer = FALSE;
	private $jsondecode_result = TRUE;

	protected $error;
	protected $success;
	protected $response;

	function __construct(array $arr = []) {
		foreach ($arr as $key => $value) {
			if ($key=='error'||$key=='success'||$key=='response') continue;
			if (isset($this->{$key}))
				$this->{$key} = $value;
		}
	}

	public function post($url) {
		$this->url = $url;
		$this->method = 'POST';
		return $this;
	}
	public function get($url) {
		$this->url = $url;
		$this->method = 'GET';
		return $this;
	}
	public function put($url) {
		$this->url = $url;
		$this->method = 'PUT';
		return $this;
	}
	public function delete($url) {
		$this->url = $url;
		$this->method = 'DELETE';
		return $this;
	}
	public function patch($url) {
		$this->url = $url;
		$this->method = 'PATCH';
		return $this;
	}
	public function options($url) {
		$this->url = $url;
		$this->method = 'OPTIONS';
		return $this;
	}
	public function method($method) {
		if (!in_array($method, $this->methods_available)) {
			$this->error = "Unidentified method `$method`";
			return false;
		}
		$this->method = $method;
		return $this;
	}
	public function data($value) {
		$this->data = (array)$value;
		return $this;
	}
	public function timeout($value) {
		$this->timeout = $value;
		return $this;
	}
	public function returntransfer($value) {
		$this->returntransfer = $value ? TRUE : FALSE;
		return $this;
	}
	public function encoding($value) {
		$this->encoding = $value;
		return $this;
	}
	public function maxredirs($value) {
		$this->maxredirs = $value;
		return $this;
	}
	public function ssl_verifyhost($value) {
		$this->ssl_verifyhost = $value ? TRUE : FALSE;
		return $this;
	}
	public function ssl_verifypeer($value) {
		$this->ssl_verifypeer = $value ? TRUE : FALSE;
		return $this;
	}
	public function fetch($url = null) {
		if ($url) $this->url = $url;
		$this->do_curl();
		return $this;
	}
	public function error() {
		return $this->error;
	}
	public function response() {
		if (!$this->response&&!$this->error&&!$this->success) $this->fetch();
		return $this->response;
	}
	public function success() {
		return $this->success;
	}

	private function do_curl() {
		$this->success = false;
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->url,
			CURLOPT_RETURNTRANSFER => $this->returntransfer,
			CURLOPT_ENCODING => $this->encoding,
			CURLOPT_MAXREDIRS => $this->maxredirs,
			CURLOPT_TIMEOUT => $this->timeout ? $this->timeout : 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $this->method,
			CURLOPT_POSTFIELDS => $this->data ? $this->data : "{}",
			CURLOPT_SSL_VERIFYHOST => $this->ssl_verifyhost,
			CURLOPT_SSL_VERIFYPEER => $this->ssl_verifypeer
		));
		// $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		// $errorno = curl_errno($curl);
		$this->response = curl_exec($curl);
		$this->error = curl_error($curl);
		$this->success = $this->response && !$this->error ? true : false;
		if ($this->jsondecode_result)
			$this->jsonify();
	}

	public function jsonify() {
		if (!is_string($this->response)) return $this;
		if (preg_match('/^\{.+\}$/', $this->response)) {
			$this->response = json_decode($this->response);
			$this->success = true;
		}else{
			$this->error .= "\nInvalid JSON. Failed to jsonify";
			$this->success = false;
			$this->response = FALSE;
		}
		return $this;
	}

}