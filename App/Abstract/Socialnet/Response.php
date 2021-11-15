<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Response.php, v2.3.8 2019/09/01 22:57:00 Exp $

/**
 * Class Response
 *
 * @package Abstract\Socialnet
 */
abstract class App_Abstract_Socialnet_Response {

    /** @var null|int The HTTP status code response from API. */
    protected $httpStatusCode;

    /** @var array The headers returned from API request. */
    protected $headers;

    /** @var string The raw body of the response from API request. */
    protected $body;

    /** @var array The decoded body of the API response. */
    protected $decodedBody = array();

    /** @var string API Endpoint used to make the request. */
    protected $endPoint;

    /** @var Request The original request that returned this response. */
    protected $request;

    /** @var CoreSDKException The exception thrown by this request. */
    protected $thrownException;

    /**
     * Data for send Sender
     *
     * @var array
     */
    protected $data;

    /**
     * Checks if response is an error.
     *
     * @return bool
     */
    abstract public function isError();

    /**
     * Checks if decodeBody is an error.
     *
     * @return bool
     */
    abstract public function isValidateBody();

    /**
     * Instantiates an exception to be thrown later.
     */
    abstract public function makeException();

    /**
     * Converts raw API response to proper decoded response.
     */
    abstract public function decodeBody();

//    /**
//     * Helper function to return the payload of a successful response.
//     *
//     * @return mixed
//     */
//    abstract public function getResult();

    /**
     * Get the value of Raw response data
     *
     * @return array
     */
    public function getData($options = array())
    {
        return $this->data;
    }

    /**
     * Return the bot access token that was used for this request.
     *
     * @return string|null
     */
    public function getAccessToken()
    {
        return $this->request->getAccessToken();
    }

    /**
     * Return the decoded body response.
     *
     * @return array
     */
    public function getDecodedBody()
    {
        return $this->decodedBody;
    }

    /**
     * Return the original request that returned this response.
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Gets the HTTP status code.
     * Returns NULL if the request was asynchronous since we are not waiting for the response.
     *
     * @return null|int
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * Gets the Request Endpoint used to get the response.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endPoint;
    }

    /**
     * Return the HTTP headers for this response.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Return the raw body response.
     *
     * @return string
     */
    public function getBody()
    {
        return trim($this->body);
    }

    /**
     * Throws the exception.
     *
     * @throws CoreSDKException
     */
    public function throwException()
    {
        throw $this->thrownException;
    }

    /**
     * Returns the exception that was thrown for this request.
     *
     * @return CoreSDKException
     */
    public function getThrownException()
    {
        return $this->thrownException;
    }
}