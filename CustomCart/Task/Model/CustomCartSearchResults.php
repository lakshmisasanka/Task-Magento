<?php

declare(strict_types=1);

namespace CustomCart\Task\Model;

use CustomCart\Task\Api\Data\CustomCartSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * CustomCartSearchResults class
 */
class CustomCartSearchResults extends SearchResults implements CustomCartSearchResultsInterface
{
}
