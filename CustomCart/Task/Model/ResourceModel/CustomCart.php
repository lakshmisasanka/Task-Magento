<?php 
namespace CustomCart\Task\Model\ResourceModel;

class CustomCart extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {

        $this->_init("customcart", "customcart_id");
    }

}
?>