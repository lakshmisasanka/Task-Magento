<?php

namespace Ziffity\Feedback\Controller\Adminhtml\View;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
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
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $feedbackView = $this->_pageFactory->create();
        $feedbackView->getConfig()->getTitle()->prepend((__('Customer Feedbacks')));
        return $feedbackView;
    }

}
