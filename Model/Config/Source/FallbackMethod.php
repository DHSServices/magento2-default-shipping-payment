<?php
/**
 * @category  DHSServices
 *
 */

namespace DHSServices\DefaultShippingPayment\Model\Config\Source;

class FallbackMethod implements \Magento\Framework\Option\ArrayInterface
{
    const NONE = 'none';
    const FIRST = 'first';
    const LAST = 'last';

    /**
     * Option array.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->toArray() as $value => $label) {
            $options[] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $options;
    }

    /**
     * Key-value pair of description options.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            self::NONE => __('None'),
            self::FIRST => __('First method'),
            self::LAST => __('Last method'),
        ];
    }
}
