<?php
declare(strict_types=1);

namespace Rafi\Reea\Model\Customer\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Rafi\Reea\Helper\Data;

class Region extends AbstractSource
{
    public function __construct(
        Data $helper
    )
    {
        $this->helper = $helper;
    }
    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        $regions = $this->helper->getCollection();
        foreach ($regions as $region) {
            $option[] = ['label'=>$region->getTitle(),'value'=>$region->getId()];
        }

        $this->_options = $option;

        return $this->_options;

    }
}
