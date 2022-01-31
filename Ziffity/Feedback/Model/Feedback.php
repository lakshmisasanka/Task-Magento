<?php

namespace Ziffity\Feedback\Model;

use Magento\Framework\Model\AbstractModel;
use Ziffity\Feedback\Api\Data\FeedbackInterface;

class Feedback extends AbstractModel implements FeedbackInterface
{
    /** Cache tag */
    const CACHE_TAG = 'ziffity_customer_feedback';

    /**
     * Initialise resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init('Ziffity\Feedback\Model\ResourceModel\Feedback');
    }

    /**
     * Get cache identities
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get feedback id
     * @return string
     */
    public function getId()
    {
        return $this->getData(FeedbackInterface::FEEDBACK_ID);
    }

    /**
     * Set feedback id
     * @param $feedback_id
     * @return $this
     */
    public function setId($feedback_id)
    {
        return $this->setData(FeedbackInterface::FEEDBACK_ID, $feedback_id);
    }

    /**
     * Get first name
     * @return string
     */
    public function getFirstName()
    {
        return $this->getData(FeedbackInterface::FIRST_NAME);
    }

    /**
     * Set first name
     * @param $first_name
     * @return $this
     */
    public function setFirstName($first_name)
    {
        return $this->setData(FeedbackInterface::FIRST_NAME, $first_name);
    }

    /**
     * Get last name
     * @return string
     */
    public function getLastName()
    {
        return $this->getData(FeedbackInterface::LAST_NAME);
    }

    /**
     * Set last name
     * @param $last_name
     * @return $this
     */
    public function setLastName($last_name)
    {
        return $this->setData(FeedbackInterface::LAST_NAME, $last_name);
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(FeedbackInterface::EMAIL);
    }

    /** Set email
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        return $this->setData(FeedbackInterface::EMAIL, $email);
    }

    /**
     * Get comment
     * @return mixed
     */
    public function getComment()
    {
        return $this->getData(FeedbackInterface::COMMENT);
    }

    /**
     * Set comment
     * @param $comment
     * @return $this
     */
    public function setComment($comment)
    {
        return $this->setData(FeedbackInterface::COMMENT, $comment);
    }

    /**
     * Get created at
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(FeedbackInterface::CREATED_AT);
    }

    /**
     * Set created at
     * @param $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(FeedbackInterface::CREATED_AT, $createdAt);
    }

    /**
     * Get updated at
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(FeedbackInterface::UPDATED_AT);
    }

    /**
     * Set updated at
     * @param $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(FeedbackInterface::UPDATED_AT, $updatedAt);
    }

    /**
     * Get status
     * @return mixed
     */
    public function getStatus()
    {
        return $this->getData(FeedbackInterface::STATUS);
    }

    /**
     * Set status
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(FeedbackInterface::STATUS, $status);
    }
}
