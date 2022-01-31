<?php

namespace Ziffity\Feedback\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Ziffity\Feedback\Model\Feedback;

class ApprovedFeedback extends Action
{

    /** @var JsonFactory */
    protected $jsonFactory;

    /** @var Feedback */
    protected $feedbackModel;

    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /**
     * ApprovedFeedback constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param Feedback $feedbackModel
     * @param ScopeConfigInterface $scopeConfig
     */

    public function __construct(Context $context, JsonFactory $jsonFactory, Feedback $feedbackModel, ScopeConfigInterface $scopeConfig)
    {
        $this->jsonFactory = $jsonFactory;
        $this->feedbackModel = $feedbackModel;
        $this->scopeConfig = $scopeConfig;
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
        $result = $this->jsonFactory->create();
        $response['feedback_status'] = false;

        $response['data'] = $this->getApprovedFeedback();

        if(!empty($response['data'])) {
            $response['feedback_status'] = true;
        }

        $result->setData($response);
        return $result;
    }

    /** @return array firstname, lastname, emailId, comment from feedback database */
    public function getApprovedFeedback()
    {
        $collection = $this->feedbackModel->getCollection();
        $collection->addFieldToSelect(array('first_name', 'last_name', 'email', 'comment'))
            ->addFieldToFilter('status', ['eq' => 1]);

        return (array) $collection->getData();
    }
}
