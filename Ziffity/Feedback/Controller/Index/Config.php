<?php

namespace Ziffity\Feedback\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Ziffity\Feedback\Helper\Data;

class Config extends Action
{

    protected $helperData;

    /**
     * @param Context $context
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        Data $helperData
    ) {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->helperData->getCustomerFeedback('enable');
    }
}
