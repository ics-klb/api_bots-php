<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Menu/Localized.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Menu;

/**
 * Class LocalizedMenu
 *
 * @package Facebook\Api\Menu
 */
class Localized
{
    private $locale;

    private $composer_input_disabled;

    private $menuItems;

    /**
     * LocalizedMenu constructor.
     *
     * @param string $locale
     * @param boolean $composer_input_disabled
     * @param null|array $menuItems
     */
    public function __construct($locale, $composer_input_disabled, $menuItems = null) {
        
        $this->locale = $locale;
        $this->composer_input_disabled = $composer_input_disabled;
        $this->menuItems = $menuItems;
    }

    public function getData(){
        $result = array(
            'locale' => $this->locale,
            'composer_input_disabled' => $this->composer_input_disabled
        );

        if(isset($this->menuItems)){
            foreach ($this->menuItems as $menuItem){
                $result['call_to_actions'][] = $menuItem->getData();
            }
        }
        return $result;
    }
}
