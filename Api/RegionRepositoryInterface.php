<?php
declare(strict_types=1);

namespace Rafi\Reea\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface RegionRepositoryInterface
{

    /**
     * Save region
     * @param \Rafi\Reea\Api\Data\RegionInterface $region
     * @return \Rafi\Reea\Api\Data\RegionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Rafi\Reea\Api\Data\RegionInterface $region
    );

    /**
     * Retrieve region
     * @param string $regionId
     * @return \Rafi\Reea\Api\Data\RegionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($regionId);

    /**
     * Retrieve region matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Rafi\Reea\Api\Data\RegionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete region
     * @param \Rafi\Reea\Api\Data\RegionInterface $region
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Rafi\Reea\Api\Data\RegionInterface $region
    );

    /**
     * Delete region by ID
     * @param string $regionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($regionId);
}

