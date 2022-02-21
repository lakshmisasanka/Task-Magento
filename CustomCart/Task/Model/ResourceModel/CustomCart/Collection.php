<?php 
namespace CustomCart\Task\Model\ResourceModel\CustomCart;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        
        $this->_init("CustomCart\Task\Model\CustomCart", "CustomCart\Task\Model\ResourceModel\CustomCart");
    }
}
?>