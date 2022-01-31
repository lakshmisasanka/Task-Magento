<?php

namespace Ziffity\Feedback\Controller\Adminhtml\View;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Review extends Action
{

    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $_pageFactory
     */
    public function __construct(Action\Context $context, PageFactory $_pageFactory)
    {
        $this->_pageFactory = $_pageFactory;
        parent::__construct($context);
    }

    /**
     * @return boolean
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ziffity_Feedback::feedback');
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $result = $this->_pageFactory->create();
        $result->getConfig()->getTitle()->set('Customer Feedbacks');
        return $result;
    }

}
