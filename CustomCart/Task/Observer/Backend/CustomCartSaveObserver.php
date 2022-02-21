<?php

namespace CustomCart\Task\Observer\Backend;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomCartSaveObserver implements ObserverInterface
{
    

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Psr\Log\LoggerInterface $logger,
        \CustomCart\Task\Model\CustomCart $customCart,
        \CustomCart\Task\Model\CustomCartRepository $customCartRepository
    ) { 
        $this->_checkoutSession = $checkoutSession;
        $this->logger = $logger;
        $this->customCart = $customCart;
        $this->customCartRepository = $customCartRepository;
    }

    public function execute(Observer $observer)
    {
        try {

            $sku = $observer->getEvent()->getData('product')->getSku();
            $quote = $this->_checkoutSession->getQuote();
            $this->customCart->setSku($sku);
            $this->customCart->setQuoteId($quote->getId());
            $this->customCart->setCustomerId($quote->getCustomerId());
            $this->customCartRepository->save($this->customCart);
            
        } catch (\Exception $e) {
           
            $this->logger->critical('Error message', ['exception' => $e]);
        }
    }
}