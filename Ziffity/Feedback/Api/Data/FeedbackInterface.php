<?php

namespace Ziffity\Feedback\Api\Data;

use Ziffity\Feedback\Block\Feedback;

interface FeedbackInterface
{
    /** Constants for keys of data array. */
    const FEEDBACK_ID           = 'feedback_id';
    const FIRST_NAME            = 'first_name';
    const LAST_NAME             = 'last_name';
    const EMAIL                 = 'email';
    const COMMENT               = 'comment';
    const CREATED_AT            = 'created_at';
    const UPDATED_AT            = 'updated_at';
    const STATUS                = 'status';

    /**
     * Get FEEDBACK ID
     * @return int|null
     */
    public function getId();

    /**
     * Set FEEDBACK_ID
     * @param $feedback_id
     * @return FeedbackInterface
     */
    public function setId($feedback_id);

    /**
     * Get First Name
     * @return string
     */
    public function getFirstName();

    /**
     * Set First Name
     * @param $first_name
     * @return mixed
     */
    public function setFirstName($first_name);

    /**
     * Get Last Name
     * @return mixed
     */
    public function getLastName();

    /**
     * Set Last Name
     * @param $last_name
     * @return mixed
     */
    public function setLastName($last_name);

    /**
     * Get Email
     * @return mixed
     */
    public function getEmail();

    /**
     * Set Email
     * @param $email
     * @return FeedbackInterface
     */
    public function setEmail($email);

    /**
     * Get Comment
     * @return string
     */
    public function getComment();

    /**
     * Set Comment
     * @param $comment
     * @return FeedbackInterface
     */
    public function setComment($comment);
    /**
     * Get created at
     * @return string
     */
    public function getCreatedAt();

    /**
     * set created at
     * @param $createdAt
     * @return FeedbackInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated at
     * @return string
     */
    public function getUpdatedAt();

    /**
     * set updated at
     * @param $updatedAt
     * @return FeedbackInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get Status
     * @return int|null
     */
    public function getStatus();

    /**
     * Set Status
     * @param $status
     * @return FeedbackInterface
     */
    public function setStatus($status);
}
