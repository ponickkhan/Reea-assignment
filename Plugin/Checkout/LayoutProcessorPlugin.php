<?php
namespace Rafi\Reea\Plugin\Checkout;

use Magento\Customer\Api\CustomerRepositoryInterface;

class LayoutProcessorPlugin
{
    protected $customerRepository;
    public function __construct(
        CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function getAttributeValue($customerId)
    {
        $customer = $this->customerRepository->getById($customerId);
        return $customer->getCustomAttribute('customer_region');
    }
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        $obj = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $obj->create('Rafi\Reea\Helper\Data');
        $customerSession = $obj->get('Magento\Customer\Model\Session');

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['before-form']['children']['order_comment'] = [
            'component' => 'Magento_Ui/js/form/element/textarea',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/textarea',
                'options' => [],
                'id' => 'order_comment'
            ],
            'dataScope' => 'shippingAddress.order_comment',
            'label' => __('Order Comment'),
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 200,
            'id' => 'order_comment'
        ];


        $regions = $helper->getCollection();

        if($customerSession->isLoggedIn()) {
            $currentRegion = $this->getAttributeValue($customerSession->getCustomer()->getId());
            $regionData = $helper->getRegion($currentRegion->getValue());
            if ($regionData->getTitle() !== null){
                $option[] = ['value'=> $currentRegion->getValue(),'label'=> $regionData->getTitle() ];
            }
        }else{
            $option[] = ['value'=>'','label'=>'Select your Region'];
        }


        foreach ($regions as $region) {
            $option[] = ['value'=>$region->getId(),'label'=>$region->getTitle()];
        }
        $this->_options = $option;

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['before-form']['children']['order_region'] = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'options' => $this->_options ,
                'id' => 'order_region'
            ],
            'dataScope' => 'shippingAddress.order_region',
            'label' => __('Order region'),
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 200,
            'id' => 'order_region'
        ];



        return $jsLayout;
    }
}
