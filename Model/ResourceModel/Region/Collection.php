<?php
declare(strict_types=1);

namespace Rafi\Reea\Model\ResourceModel\Region;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'region_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Rafi\Reea\Model\Region::class,
            \Rafi\Reea\Model\ResourceModel\Region::class
        );
    }
}

