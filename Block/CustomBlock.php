<?php

namespace Rafi\Reea\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Page\Config;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\OrderRepositoryInterface;

class CustomBlock extends Template
{
    public $orderRepository;

    public function __construct(
        Context $context,
        Config $pageConfig,
        OrderRepositoryInterface $orderRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->orderRepository = $orderRepository;
        $this->pageConfig = $pageConfig;
    }

    public function getOrder()
    {
        $orderId = $this->getRequest()->getParam('order_id');
        return $this->orderRepository->get($orderId);
    }
}
?>
