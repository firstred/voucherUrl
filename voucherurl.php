<?php
/**
 * 2017 Thirty Bees
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@thirtybees.com so we can send you a copy immediately.
 *
 * @author    Thirty Bees <modules@thirtybees.com>
 * @copyright 2017 Thirty Bees
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 * Class voucherUrl
 */
class voucherurl extends Module
{

    /**
     * voucherUrl constructor.
     */
    public function __construct()
    {
        $this->name = 'voucherurl';
        $this->tab = 'advertising_marketing';
        $this->version = 0.1;
        $this->author = 'Pablo Garcia';

        parent::__construct();

        $this->displayName = $this->l('Discount URL');
        $this->description = $this->l('Allow for a discount URL');
    }

    /**
     * Install this module
     *
     * @return bool
     */
    public function install()
    {
        if (!parent::install() || !$this->registerHook('header')) {
            return false;
        }

        return true;
    }

    /**
     * Hook to header
     */
    public function hookHeader()
    {
        if (Tools::isSubmit('voucher')) {
            $idCartRule = (int) CartRule::getIdByCode(Tools::getValue('voucher'));
            if ($idCartRule) {
                $this->context->cart->addCartRule($idCartRule);
                $this->context->controller->confirmations[] = $this->l('A voucher has been added to your cart!');
            }
        }
    }
}
