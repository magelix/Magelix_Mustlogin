<?php

/**
 * Created by PhpStorm.
 * User: juergen
 * Date: 04.04.14
 * Time: 20:25
 */
class Magelix_Mustlogin_Block_Html_Head extends Mage_Page_Block_Html_Head
{
    /**
     * Enhance the constructor by a check if customer is logged in
     * if not redirects to login.
     */
    protected function _construct()
    {
        $helper = $this->helper('magelix_mustlogin');

        if ($helper->isMustLoginEnabled()) {
            if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
                $login_url = Mage::getUrl('customer/account/login');
                if ($helper->isRedirectLogin()) {
                    if ($this->getRequest()->getModuleName() != 'customer') {
                        Mage::app()->getFrontController()->getResponse()->setRedirect($login_url);
                    }
                } else {
                    $redirect_url = $helper->getRedirectPage();
                    $current_url = $this->helper('core/url')->getCurrentUrl();
                    if ( $current_url != $redirect_url && $current_url != $login_url) {
                        Mage::app()->getFrontController()->getResponse()->setRedirect($redirect_url);
                    }
                }
            }
        }
        parent::_construct();
    }
}