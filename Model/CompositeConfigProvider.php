<?php
/**
 * @category  DHSServices
 *
 */

namespace DHSServices\DefaultShippingPayment\Model;

use Magento\Store\Model\ScopeInterface;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class CompositeConfigProvider implements ConfigProviderInterface
{
    /**
     * ScopeConfigInterface.
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $config = [];
        if ($this->isEnabled('shipping')) {
            $config['shipping'] = $this->prepareConfig('shipping');
        }

        if ($this->isEnabled('payment')) {
            $config['payment'] = $this->prepareConfig('payment');
        }

        return ['dhsservicesDefaultShippingPayment' => $config];
    }

    /**
     * Prepare config.
     *
     * @param string $type
     *
     * @return array
     */
    public function prepareConfig($type)
    {
        return [
            'autoselect' => $this->getConfigValue(sprintf('%s/autoselect_method', $type)),
            'fallback' => $this->getConfigValue(sprintf('%s/fallback_method', $type)),
        ];
    }

    /**
     * Get config value by path.
     *
     * @param string $path
     *
     * @return mixed
     */
    public function getConfigValue($type)
    {
        return $this->scopeConfig->getValue(
            sprintf('dhsservices_default_shipping_payment/%s', $type),
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get config flag by path.
     *
     * @param string $path
     *
     * @return bool
     */
    public function isEnabled($type)
    {
        return $this->scopeConfig->isSetFlag(
            sprintf('dhsservices_default_shipping_payment/%s/autoselect_method', $type),
            ScopeInterface::SCOPE_STORE
        );
    }
}
