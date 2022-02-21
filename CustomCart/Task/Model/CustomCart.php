<?php 
namespace CustomCart\Task\Model;

use CustomCart\Task\Api\Data\CustomCartInterface;

class CustomCart extends \Magento\Framework\Model\AbstractModel implements CustomCartInterface
{

   protected function _construct()
    {

        $this->_init("CustomCart\Task\Model\ResourceModel\CustomCart");
    }

    public function getCustomCartId() 
    {

        return $this->getData(Self::CUSTOMCART_ID);
    }

    
    public function setCustomCartId($customcart_id)
    {

        return $this->setData(Self::CUSTOMCART_ID, $customcart_id);
    }


    public function getSku()
    {
        return $this->getData(Self::SKU);
    }

    
    public function setSku($sku)
    {
        return $this->setData(Self::SKU, $sku);
    }

    
    public function getCustomerId()
    {
        return $this->getData(Self::CUSTOMER_ID);
    }

    
    public function setCustomerId($customer_id)
    {
        return $this->setData(Self::CUSTOMER_ID, $customer_id);
    }
   
   
    public function getQuoteId()
    {
        return $this->getData(Self::QUOTE_ID);
    }

   
    public function setQuoteId($quote_id)
    {
        return $this->setData(Self::QUOTE_ID, $quote_id);
    }

   
    public function getCreatedAt()
    {
        return $this->getData(Self::CREATED_AT);
    }

    
    public function setCreatedAt($created_at)
    {
        return $this->setData(Self::CREATED_AT, $created_at);
    }

   
    public function getUpdatedAt()
    {
        return $this->getData(Self::UPDATED_AT);
    }

   
    public function setUpdatedAt($updated_at)
    {
        return $this->setData(Self::UPDATED_AT, $updated_at);
    }

   
    
}

?>