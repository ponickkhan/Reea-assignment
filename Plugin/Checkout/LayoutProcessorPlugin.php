<?php
namespace Rafi\Reea\Plugin\Checkout;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Rafi\Reea\Helper\Data;
use Magento\Customer\Model\Session;
class LayoutProcessorPlugin
{
    protected $customerRepository;
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        Data $helper,
        Session $customerSession
    )
    {
        $this->customerRepository = $customerRepository;
        $this->helper = $helper;
        $this->customerSession = $customerSession;
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


        $regions = $this->helper->getCollection();
        if($this->customerSession->isLoggedIn()) {
            $currentRegion = $this->getAttributeValue($this->customerSession->getCustomer()->getId());
            $regionData = $this->helper->getRegion($currentRegion->getValue());
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
