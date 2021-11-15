<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Menu/MenuItem.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Menu;

/**
 * Class MessageButton
 *
 * @package Facebook\Api\Menu
 */
class Item
{
    /**
     * Web url button type
     */
    const TYPE_WEB = "web_url";

    /**
     * Postback button type
     */
    const TYPE_POSTBACK = "postback";
    
    /**
     * Postback button type
     */
    const TYPE_NESTED = "nested";

    /**
     * Button type
     *
     * @var string
     */
    protected $type;

    /**
     * Button title
     *
     * @var string
     */
    protected $title;

    /**
     * Button url
     *
     * @var string|array
     */
    protected $data = null;
    
    /**
     * Webview height ratio ("compact", "tall" or "full")
     *
     * @var null|string
     */
    protected $webview_height_ratio = null;

    /**
     * Messenger extensions which enable your web page to integrate with Messenger using js
     *
     * @var boolean
     */
    protected $messenger_extensions = false;

    /**
     * Fallback url to use on clients that don't support Messenger Extensions
     *
     * @var null|string
     */
    protected $fallback_url = null;

    /*
     * Set to hide to disable sharing in the webview (for sensitive info).
     * 
     * @var null|string
     */
    protected $webview_share_button = null;

    /**
     * MessageButton constructor.
     *
     * @param string $type
     * @param string $title
     * @param string|array $data
     */
    public function __construct($type, $title, $data, $webview_height_ratio = ''
                              , $messenger_extensions = false, $fallback_url = '', $webview_share_button =  null)
    {
        $this->type = $type;
        $this->title = $title;
        $this->data = $data;

        $this->webview_height_ratio = $webview_height_ratio;
        $this->messenger_extensions = $messenger_extensions;
        $this->fallback_url = $fallback_url;
        $this->webview_share_button = $webview_share_button;

    }

    /**
     * Get Button data
     * 
     * @return array
     */
    public function getData()
    {
        $result = array();
        $result['type'] = $this->type;
        $result['title'] = $this->title;

        switch($this->type)
        {
            case self::TYPE_POSTBACK:
                $result['payload'] = $this->data;
            break;

            case self::TYPE_WEB:
              $result['url'] = $this->data;
              
              if ($this->webview_height_ratio) {
                  $result['webview_height_ratio'] = $this->webview_height_ratio;
              }
              
              if ($this->messenger_extensions){
                  $result['messenger_extensions'] = $this->messenger_extensions;
                  $result['fallback_url'] = $this->fallback_url;
              }
              
              if($this->webview_share_button){
                  $result['webview_share_button'] = $this->webview_share_button;
              }
            break;
            
            case self::TYPE_NESTED:
                foreach ($this->data as $item) {
                    $result['call_to_actions'][] = $item->getData();
                }
            break;
        }
        return $result;
    }
}
