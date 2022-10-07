<?php
declare(strict_types=1);

namespace Rafi\Reea\Api\Data;

interface RegionInterface
{

    const TITLE = 'title';
    const STATUS = 'status';
    const DESCRIPTION = 'description';
    const REGION_ID = 'region_id';

    /**
     * Get region_id
     * @return string|null
     */
    public function getRegionId();

    /**
     * Set region_id
     * @param string $regionId
     * @return \Rafi\Reea\Region\Api\Data\RegionInterface
     */
    public function setRegionId($regionId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Rafi\Reea\Region\Api\Data\RegionInterface
     */
    public function setTitle($title);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Rafi\Reea\Region\Api\Data\RegionInterface
     */
    public function setDescription($description);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Rafi\Reea\Region\Api\Data\RegionInterface
     */
    public function setStatus($status);
}

