<?php 
namespace Task\Preorder\Model\ResourceModel;

class Preorder extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function _construct(){

        $this->_init("preorder","preorder_id");
    }

}
?>