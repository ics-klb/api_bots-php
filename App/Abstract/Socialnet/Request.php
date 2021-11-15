<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Request.php, v2.3.8 2019/09/01 22:57:00 Exp $

/**
 * Class Request
 *
 * @package Abstract\Socialnet
 */
abstract class App_Abstract_Socialnet_Request {

    protected $base_uri = '';
    protected $options;


    /** @var string|null The bot access token to use for this request. */
    protected $access;

    /** @var string The HTTP method for this request. */
    protected $method;

    /** @var string The API endpoint for this request. */
    protected $endpoint;

    /** @var array The headers to send with this request. */
    protected $headers = array();

    /** @var array The parameters to send with this request. */
    protected $params = array();

    /** @var array The files to send with this request. */
    protected $files = array();

    /** @var bool Indicates if the request to Telegram will be asynchronous (non-blocking). */
    protected $isAsyncRequest = false;

    /** @var int Timeout of the request in seconds. */
    protected $timeOut = 60;

    /** @var int Connection timeout of the request in seconds. */
    protected $connectTimeOut = 10;

    /** @var Response|null Stores the last request made to Telegram Bot API. */
    protected $lastResponse;

    protected  $relative_url = array();


    abstract public function getUrl();

    abstract public function getType();

    public function getBaseUrl() {

        return $this->base_uri;
    }

    public function setBaseUrl($uri) {

        $this->base_uri = $uri;

        return $this;
    }

    /**
     * Make this request asynchronous (non-blocking).
     *
     * @param $isAsyncRequest
     *
     * @return Request
     */
    public function setAsyncRequest($isAsyncRequest)
    {
        $this->isAsyncRequest = $isAsyncRequest;

        return $this;
    }

    /**
     * Check if this is an asynchronous request (non-blocking).
     *
     * @return bool
     */
    public function isAsyncRequest()
    {
        return $this->isAsyncRequest;
    }

    public function getStatusCode()
    {
        return $this->status;
    }
    /**
     * Return the full data for this request.
     *
     * @return array
     */
    public function toArray()
    {
        $_request = array(
            'method'   => $this->getMethod(),
            'type'     => $this->getType(),
            'url'      => $this->getUrl(),

            'headers'  => $this->getHeaders(),
            'params'   => $this->getParams(),
            'body'     => $this->getBody(),
            'timeOut'  => $this->getTimeOut(),
            'access'   => $this->getAccess(),
            'isasync'   => $this->isAsyncRequest()
        );
        return $_request;
    }

    /**
     * Return the headers for this request.
     *
     * @return array
     */
    public function getHeaders()
    {
        $headers = $this->getDefaultHeaders();

        return array_merge($this->headers, $headers);
    }

    /**
     * Set the headers for this request.
     *
     * @param string|array $name Header name, full header string ('Header: value')
     *     or an array of headers
     *
     * @return Request
     */
    public function setHeaders($name, $value = null)
    {
        // If we got an array, go recursive!
        if (is_array($name)) {
            foreach ($name as $k => $v) {
                if (is_string($k)) {
                    $this->setHeaders($k, $v);
                } else {
                    $this->setHeaders($v, null);
                }
            }
        } else {
            // Check if $name needs to be split
            if ($value === null && (strpos($name, ':') > 0)) {
                list($name, $value) = explode(':', $name, 2);
            }

            $normalized_name = strtolower($name);

            // If $value is null or false, unset the header
            if ($value === null || $value === false) {
                unset($this->headers[$normalized_name]);

                // Else, set the header
            } else {
                // Header names are stored lowercase internally.
                if (is_string($value)) {
                    $value = trim($value);
                }
                $this->headers[$normalized_name] = array($name, $value);
            }
        }

        return $this;
    }

    /**
     * The default headers used with every request.
     *
     * @return array
     */
    public function getDefaultHeaders()
    {
        return array(
//            'User-Agent' => 'Core SDK v2.3.8',
        );
    }

    /**
     * Only return params on POST requests.
     *
     * @return array
     */
    public function getPostParams()
    {
        if ($this->getMethod() === 'POST') {
            return $this->getParams();
        }

        return array();
    }

    /**
     * Return the HTTP method for this request.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the HTTP method for this request.
     *
     * @param string
     *
     * @return Request
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);

        return $this;
    }

    /**
     * Return the params for this request.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set the params for this request.
     *
     * @param array $params
     *
     * @return Request
     */
    public function setParams(array $params = array())
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    /**
     * Return the body for this request.
     *
     * @return array
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set the body for this request.
     *
     * @param array $headers
     *
     * @return Request
     */
    public function setAccess($access)
    {
        $this->access = $access;
        return $this;
    }

    /**
     * Return the body for this request.
     *
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the body for this request.
     *
     * @param array $headers
     *
     * @return Request
     */
    public function setBody($body)
    {
            $this->body = $body;
        return $this;
    }

    /**
     * Get Timeout.
     *
     * @return int
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * Set Timeout.
     *
     * @param int $timeOut
     *
     * @return Request
     */
    public function setTimeOut($timeOut)
    {
        $this->timeOut = (int) $timeOut;
        return $this;
    }

    /**
     * Get Connection Timeout.
     *
     * @return int
     */
    public function getConnectTimeOut()
    {
        return $this->connectTimeOut;
    }

    /**
     * Set Connection Timeout.
     *
     * @param int $connectTimeOut
     *
     * @return Request
     */
    public function setConnectTimeOut($connectTimeOut)
    {
        $this->connectTimeOut = (int) $connectTimeOut;

        return $this;
    }

    /**
     * Return the bot access token for this request.
     *
     * @return string|null
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set the bot access token for this request.
     *
     * @param string $accessToken
     *
     * @return Request
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Return the API Endpoint for this request.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Set the endpoint for this request.
     *
     * @param string $endpoint
     *
     * @return Request
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }


    public function getRelativeUrl() {

        return is_array($this->relative_url)
            ? implode('/', $this->relative_url)
            : $this->relative_url;
    }

    public function addRelativeUrl(array $uri) {

        $this->relative_url = array_push($this->relative_url, $uri);

        return $this;
    }

    public function setRelativeUrl($uri) {

        $this->relative_url = $uri;

        return $this;
    }
}