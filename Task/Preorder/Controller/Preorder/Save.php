<?php
namespace Task\Preorder\Controller\Preorder;
 
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Task\Preorder\Model\PreorderFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
 
class Save extends Action
{
    protected $resultPageFactory;
    protected $preorderFactory;
 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        PreorderFactory $preorderFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->preorderFactory = $preorderFactory;
        parent::__construct($context);
    }
 
    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getPost();
            
            if ($data) {
                $model = $this->preorderFactory->create();
                $model->setData($data)->save();
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
 
    }
}