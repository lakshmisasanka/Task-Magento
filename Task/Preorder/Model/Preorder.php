<?php 
namespace Task\Preorder\Model;

class Preorder extends \Magento\Framework\Model\AbstractModel
{

	public function _construct(){

		$this->_init("Task\Preorder\Model\ResourceModel\Preorder");
	}
}
?>