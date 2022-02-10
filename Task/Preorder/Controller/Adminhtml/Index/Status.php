<?php

namespace Task\Preorder\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Task\Preorder\Model\PreorderFactory;
use Task\Preorder\Model\ResourceModel\Preorder\CollectionFactory;
use Task\preorder\Helper\SendEmail;

class Status extends Action
{
    protected $filter;
    protected $collectionFactory;
    protected $preorderFactory;
   

    public function __construct(
        Context $context,
        Filter $filter,
        PreorderFactory $preorderFactory,
        CollectionFactory $collectionFactory,
        SendEmail $mailer
    )
    {
        parent::__construct($context);
        $this->filter = $filter;
        $this->preorderFactory = $preorderFactory;
        $this->collectionFactory = $collectionFactory;
        $this->mailer = $mailer;
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $updated = 0;
            
            foreach ($collection as $item) {
                $model = $this->preorderFactory->create()->load($item['preorder_id']);
                $status = $this->getRequest()->getParam('status');
                $model->setData('status', $status);
                if($status == 1){
                $mailStatus = $this->mailer->sendMail("notify" , (array)$item->getData());
                }
                else{
                $mailStatus = $this->mailer->sendMail("cancel" , (array)$item->getData());   
                }
                $model->save();
                $updated++;
            }
            if ($updated) {
                $this->messageManager->addSuccess(__('A total of %1 record(s) were updated.', $updated));
            }

        } catch (\Exception $e) {
            \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->info($e->getMessage());
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

    protected function _isAllowed()
    {
        return true;
    }
}