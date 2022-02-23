<?php
/**
 * @category  DHSServices
 *
 */

namespace DHSServices\DefaultShippingPayment\Observer;

use Magento\Framework\Event\ObserverInterface;

class Register implements ObserverInterface
{
    /**
     * @var \DHSServices\DefaultShippingPayment\Helper\Data
     */
    protected $helper;

    /**
     * @param \DHSServices\DefaultShippingPayment\Helper\Data $helper
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \DHSServices\DefaultShippingPayment\Helper\Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Register extension.
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        //$this->helper->register('DHSServices_DefaultShippingPayment', '1.0.0', 'confirm');
    }
}
