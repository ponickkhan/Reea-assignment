<?php
namespace Rafi\Reea\Observer;
class SaveToOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        $quote = $event->getQuote();
        $order = $event->getOrder();
        $order->setData('order_comment', $quote->getData('order_comment'));
        $order->setData('order_region', $quote->getData('order_region'));
    }
}
