<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Abstract\Integration\Account.php, v1.03 2020/09/01 12:23:00 Exp $


/**
 * Class Account
 *
 * @package Abstract\Socialnet
 * Предназанчен для организации работы с сервисами.
 * Параметры доступа к аккаунту для подключения
 */
abstract class App_Abstract_Socialnet_Account
{

    protected $token   = '';

    protected $_properties   = array();

    /** @var HttpClientInterface|null HTTP Client. */
    protected $httpClientHandler;

    protected $request;

    /**
     * Instantiates an exception to be thrown later.
     */
    abstract public function thrownException($message, $except = null);

    /**
     * Get an API request and process the result.
     *
     * @return Request
     */
    abstract public function getRequest();

    /**
     * Send an API request and process the result.
     *
     * @param Request $request
     * @return Response|false
     */
    abstract public function setRequest($request = null);

    /**
     * Send an API request and process the result.
     *
     * @param Request $request
     *
     * @throws CoreSDKException
     *
     * @return Response|false
     */
    abstract public function sendRequest($request = null);

    /**
     * Prepares the API request for sending to the client handler.
     *
     * @param Request $request
     *
     * @return array
     */
    public function prepareRequest(Request $request)
    {
        return array(
            $this->getUrl($request),
            $request->getMethod(),
            $request->getHeaders(),
            $request->isAsyncRequest(),
        );
    }

    /**
     * Creates response object.
     *
     * @param Request                    $request
     * @param ResponseInterface|PromiseInterface $response
     *
     * @return Response
     */
    protected function getResponse(Request $request, $response)
    {
        return new Response($request, $response);
    }

    /**
     * @param Request $request
     * @param $method
     *
     * @return array
     */
    protected function getOption(Request $request, $method)
    {
        if ($method === 'POST') {
            return $request->getPostParams();
        }

        return array('query' => $request->getParams());
    }

    /**
     * @param string
     *
     * @return array
     */
    public function getProperties($name = false)
    {
        return $name ? (isset($this->_properties[$name]) ? $this->_properties[$name] : null)
                     : $this->_properties;
    }

    /**
     * Set properties url.
     *
     * @param string $name
     * @param string $value
     *
     */
    public function setProperties($name, $value)
    {
        $this->_properties[$name] = $value;
        return $this;
    }

}