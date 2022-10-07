<?php
declare(strict_types=1);

namespace Rafi\Reea\Api\Data;

interface RegionSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get region list.
     * @return \Rafi\Reea\Api\Data\RegionInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     * @param \Rafi\Reea\Api\Data\RegionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

