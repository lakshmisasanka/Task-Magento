<?php

namespace Ziffity\Feedback\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /** @var PageFactory */
    protected $pageFactory;

    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(Context $context, PageFactory $pageFactory, ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     * Note: Request will be added as operation argument in future
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
            $custom_form_page = $this->pageFactory->create();
            $custom_form_page->getConfig()->getTitle()->set(__('Feedback'));
            return $custom_form_page;
    }
}
