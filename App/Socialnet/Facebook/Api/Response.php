<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api;

/**
 * Class Response
 *
 * @package Facebook\Api
 *
 * Manage backend response, translate api error ot exception
 */
class Response extends \App_Abstract_Socialnet_Response
{
    /**
     * Create api response from http-response
     *
     * @param  $response, $headers
     * @return Response
     */
    public static function create($response, $headers = null)
    {

        if ( is_object($response) && $response instanceof Response ) {
            $item = new self();
                $item->headers = $response->getHeaders();
                $item->body    = $response->getBody();
                $item->decodeBody();

            return $item;
        } elseif ( !empty($response) ) {

            $item = new self();
                $item->body    = trim($response);
                $item->decodeBody();

            return $item;
        }

        throw new Exceptions\CoreSDKException("Invalid response json");
    }

    public function isValidateBody() {

        if (isset($this->decodedBody['status'])) {

            if ($this->decodedBody['status'] != 0) {

                throw new Exceptions\CoreSDKException(
                       'Remote error: '
                    . (isset($this->decodedBody['status_message']) ? $this->decodedBody['status_message'] : '-')
                    , $this->decodedBody['status']);
            }
        }
        return true;
    }

    /**
     * Converts raw API response to proper decoded response.
     */
    public function decodeBody()
    {
        $this->decodedBody = \Core_Api::json_decode($this->body, true);

        if ($this->decodedBody === null) {
            $this->decodedBody = array();
            parse_str($this->body, $this->decodedBody);
        }

        if (! is_array($this->decodedBody)) {
            $this->decodedBody = array();
        }

        if ($this->isError()) {
            $this->makeException();
        }
    }

    public function getData($options = array()) {

        $content = $this->decodedBody;

        if ( $this->isError() ) return array();

        foreach($content as $key => $value ) {
            $content[$key]  =  getsafedata($value);
        }

        $_fields = $content;
        if ( isset($content['phone']) ) {

            $_fields = array(
                'phone'      => valid_onlynum($content['phone'])
              , 'posttime'   => $content['time']
              , 'extra_id'   => $content['extra_id']
              , 'message_id' => $content['message_id']
              , 'message'    => $content['text_from_subscriber']
              , 'question'   => $content['text_to_subscriber']
            );
        }
        else if ( isset($content['number']) ) {

            $_fields = array(
                  'phone'     => valid_onlynum($content['number']),
                  'posttime'  => $content['time'],
                  'message'   => ''
            );
        } else {

            $_fields = array(
                 'message'   => ''
            );
        }

        $_result = array(
            'messager' => $_fields,
            'content'  => \Core_Api::getInstance()->serialize($this->decodedBody),
            'options'  => array(
                 'remoteIp'  => $options['ip']
            )
        );
        return $_result;
    }

    /**
     * Checks if response is an error.
     *
     * @return bool
     */
    public function isError()
    {
        return json_last_error() || sizeof($this->decodedBody) == 0;
    }

    /**
     * Instantiates an exception to be thrown later.
     */
    public function makeException()
    {
        $this->thrownException = new Exceptions\CoreSDKException('Error response data' . $this->body);
    }

}
