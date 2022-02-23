<?php
/**
 * @category  DHSServices
 *
 */

namespace DHSServices\DefaultShippingPayment\Model\Config\Source;

class FallbackMethodShipping extends FallbackMethod
{
    const LOWEST_PRICE = 'lowest_price';

    /**
     * Key-value pair of description options.
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            self::LOWEST_PRICE => __('Lowest Price'),
        ]);
    }
}
