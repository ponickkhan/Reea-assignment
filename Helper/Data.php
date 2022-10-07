<?php
declare(strict_types=1);

namespace Rafi\Reea\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{

    protected $_regionCollectionFactory;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context,
        \Rafi\Reea\Model\ResourceModel\Region\CollectionFactory $regionCollectionFactory,
        \Rafi\Reea\Model\RegionFactory $regionFactory
    ) {
        $this->_regionCollectionFactory = $regionCollectionFactory;
        $this->_regionFactory = $regionFactory;
        parent::__construct($context);
    }

    public function getCollection()
    {
        $collection = $this->_regionCollectionFactory->create()
            ->addFieldToFilter('status', ['eq' => 1]);
        return $collection;
    }

    public function getRegion($id)
    {
        return $this->_regionFactory->create()->load($id);
    }
}
