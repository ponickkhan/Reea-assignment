<?php
declare(strict_types=1);

namespace Rafi\Reea\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Region extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('rafi_reea_region', 'region_id');
    }
}

