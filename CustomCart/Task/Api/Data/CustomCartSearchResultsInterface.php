<?php

namespace CustomCart\Task\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * CustomCartSearchResultsInterface interface
 */
interface CustomCartSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get customCart list.
     *
     * @return \CustomCart\Task\Api\Data\CustomCartInterface[]
     */
    public function getItems();

    /**
     * Set customCart list.
     *
     * @param \CustomCart\Task\Api\Data\CustomCartInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
