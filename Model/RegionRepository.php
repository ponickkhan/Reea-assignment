<?php
declare(strict_types=1);

namespace Rafi\Reea\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Rafi\Reea\Api\Data\RegionInterface;
use Rafi\Reea\Api\Data\RegionInterfaceFactory;
use Rafi\Reea\Api\Data\RegionSearchResultsInterfaceFactory;
use Rafi\Reea\Api\RegionRepositoryInterface;
use Rafi\Reea\Model\ResourceModel\Region as ResourceRegion;
use Rafi\Reea\Model\ResourceModel\Region\CollectionFactory as RegionCollectionFactory;

class RegionRepository implements RegionRepositoryInterface
{

    /**
     * @var ResourceRegion
     */
    protected $resource;

    /**
     * @var Region
     */
    protected $searchResultsFactory;

    /**
     * @var RegionCollectionFactory
     */
    protected $regionCollectionFactory;

    /**
     * @var RegionInterfaceFactory
     */
    protected $regionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceRegion $resource
     * @param RegionInterfaceFactory $regionFactory
     * @param RegionCollectionFactory $regionCollectionFactory
     * @param RegionSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceRegion $resource,
        RegionInterfaceFactory $regionFactory,
        RegionCollectionFactory $regionCollectionFactory,
        RegionSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->regionFactory = $regionFactory;
        $this->regionCollectionFactory = $regionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(RegionInterface $region)
    {
        try {
            $this->resource->save($region);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the region: %1',
                $exception->getMessage()
            ));
        }
        return $region;
    }

    /**
     * @inheritDoc
     */
    public function get($regionId)
    {
        $region = $this->regionFactory->create();
        $this->resource->load($region, $regionId);
        if (!$region->getId()) {
            throw new NoSuchEntityException(__('region with id "%1" does not exist.', $regionId));
        }
        return $region;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->regionCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(RegionInterface $region)
    {
        try {
            $regionModel = $this->regionFactory->create();
            $this->resource->load($regionModel, $region->getRegionId());
            $this->resource->delete($regionModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the region: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($regionId)
    {
        return $this->delete($this->get($regionId));
    }
}

