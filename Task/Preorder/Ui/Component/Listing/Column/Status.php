<?php

namespace Task\Preorder\Ui\Component\Listing\Column;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Customer Notified')],
            ['value' => 0, 'label' => __('Cancelled')],
            ['value' => null, 'label' => __('Pending')]
        ];
    }
}