<?php

namespace Ziffity\Feedback\Block;

use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template;

class Feedback extends Template
{
    /** @var SessionFactory */
    protected $session;

    /** @var */
    protected $customerData;

    /**
     * Feedback constructor.
     * @param Template\Context $context
     * @param SessionFactory $session
     * @param array $data
     */

    public function __construct(
        Template\Context $context,
        SessionFactory $session,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->session= $session->create();
        $this->customerData = ($this->session->isLoggedIn()) ? $this->session->getCustomerData() : null;
    }

    /**
     * Get form action URL for POST booking request
     * @return string
     */
    public function getFormAction()
    {
        return '/feedback';
    }

    public function getCustomerFirstName()
    {
        return ($this->customerData) ? $this->customerData->getFirstname() : '';
    }

    public function getCustomerLastName()
    {
        return ($this->customerData) ? $this->customerData->getLastname() : '';
    }

    public function getCustomerEmail()
    {
        return ($this->customerData) ? $this->customerData->getEmail() : '';
    }
}
