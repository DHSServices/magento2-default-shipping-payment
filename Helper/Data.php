<?php

namespace DHSServices\DefaultShippingPayment\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Extension registration URL.
     */
    const EXTENSION_REGISTER_URL = 'https://www.hungersoft.com/register-module.php';

    /**
     * @var \Magento\Store\Model\StoreManager
     */
    private $storeManager;

    /**
     * @var \Magento\Backend\Model\Session
     */
    private $session;
    
    /**
     * @var \Magento\Framework\HTTP\Client\Curl
     */
    private $curl;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManager     $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManager $storeManager,
        \Magento\Backend\Model\Session $session,
        \Magento\Framework\HTTP\Client\Curl $curl
    ) {
        $this->storeManager = $storeManager;
        $this->session = $session;
        $this->curl = $curl;

        parent::__construct($context);
    }

    /**
     * Register module
     *
     * @param        $module
     * @param        $version
     * @param string $type
     */
    public function register($module, $version, $type = 'install')
    {
        if (null === $module || null === $version) {
            return;
        }

        $sessionDataKey = 'is_registered_' . $module;
        if ($this->session->getData($sessionDataKey)) {
            return;
        }

        try {
            $this->curl->post(self::EXTENSION_REGISTER_URL, [
                'module'   => $module,
                'version'  => $version,
                'site_url' => $this->getAllUrls(),
                'type'     => $type,
            ]);

            $this->session->setData($sessionDataKey, true);
        } catch (\Exception $e) {
        }
    }

    /**
     * Get urls of all the stores in the magento install.
     *
     * @return array
     */
    public function getAllUrls()
    {
        $urls = [];
        $stores = $this->storeManager->getStores(false);
        foreach ($stores as $store) {
            $urls[] = $store->getBaseUrl();
        }

        return $urls;
    }
}
