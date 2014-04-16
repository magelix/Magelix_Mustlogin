<?php
/**
 * Created by PhpStorm.
 * User: juergen
 * Date: 16.04.14
 * Time: 21:24
 */
class Magelix_Mustlogin_Model_Observer
{
    public function setredirect(Varien_Event $observer)
    {
       // die (Mage::helper('core/url')->getCurrentUrl());
        $helper = Mage::helper('magelix_mustlogin');

        if ($helper->isMustLoginEnabled()) {
            if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
                $login_url = Mage::getUrl('customer/account/login');
                if ($helper->isRedirectLogin()) {
                    if ($this->getRequest()->getModuleName() != 'customer') {
                        Mage::app()->getFrontController()->getResponse()->setRedirect($login_url);
                    }
                } else {
                    $redirect_url = $helper->getRedirectPage();
                    $current_url = Mage::helper('core/url')->getCurrentUrl();
                    if ( $current_url != $redirect_url && $current_url != $login_url) {
                        Mage::app()->getFrontController()->getResponse()->setRedirect($redirect_url);
                    }
                }
            }
        }

    }
}