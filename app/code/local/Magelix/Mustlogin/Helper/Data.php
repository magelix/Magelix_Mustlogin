<?php

/**
 * Created by PhpStorm.
 * User: juergen
 * Date: 04.04.14
 * Time: 18:35
 */
class Magelix_Mustlogin_Helper_Data extends Mage_Core_Helper_Abstract
{

    const XML_PATH_MUST_LOGIN_SETTINGS = 'customer/must_login/';

    public function isMustLoginEnabled()
    {
       return Mage::getStoreConfigFlag(self::XML_PATH_MUST_LOGIN_SETTINGS . 'is_mustlogin_active');
    }
    public function getRedirectPage()
    {
        $identifier = Mage::getStoreConfig(self::XML_PATH_MUST_LOGIN_SETTINGS . 'redirect_page');
        if($identifier){
            $url = Mage::getUrl($identifier);
            return $url;
        }
        return false;
    }
    public function isRedirectLogin()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_MUST_LOGIN_SETTINGS . 'is_redirect_login');
    }
}