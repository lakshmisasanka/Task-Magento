<?php 
namespace Task\Preorder\Model\ResourceModel\Preorder;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	public function _construct(){
		
        $this->_init("Task\Preorder\Model\Preorder","Task\Preorder\Model\ResourceModel\Preorder");
	}
}
 ?>