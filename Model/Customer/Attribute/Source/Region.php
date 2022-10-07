<?php
declare(strict_types=1);

namespace Rafi\Reea\Model\Customer\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Region extends AbstractSource
{

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        $obj = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $obj->create('Rafi\Reea\Helper\Data');
        $regions = $helper->getCollection();
        foreach ($regions as $region) {
            $option[] = ['label'=>$region->getTitle(),'value'=>$region->getId()];
        }
        $this->_options = $option;

        return $this->_options;

    }
}
