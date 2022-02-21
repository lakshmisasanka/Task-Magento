<?php

namespace CustomCart\Task\Api\Data;

/**
 * CustomCartInterface interface
 */
interface CustomCartInterface
{

    const CUSTOMCART_ID         = 'customcart_id';
    const SKU                   = 'sku';
    const CUSTOMER_ID           = 'customer_id';
    const QUOTE_ID              = 'quote_id';
    const STATUS                = 'status';
    const CREATED_AT            = 'created_at';
    const UPDATED_AT            = 'updated_at';

    /**
     * GetCustomCartId
     *
     * @return int|null
     */
    public function getCustomCartId();

    /**
     * Set CustomCart Id
     *
     * @param  [int] $customcart_id
     * @return CustomCartInterface
     */
    public function setCustomCartId($customcart_id);

    /**
     * Get Sku
     *
     * @return string
     */
    public function getSku();

    /**
     * Set Sku
     *
     * @param  [string] $sku
     * @return CustomCartInterface
     */
    public function setSku($sku);

    /**
     * Get Customer Id
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Set Customer Id
     *
     * @param  [int] $customer_id
     * @return CustomCartInterface
     */
    public function setCustomerId($customer_id);

    /**
     * Get Quote Id
     *
     * @return void
     */
    public function getQuoteId();

    /**
     * Undocumented function
     *
     * @param  [int] $quote_id
     * @return CustomCartInterface
     */
    public function setQuoteId($quote_id);

    /**
     * Get Created At 
     *
     * @return void
     */
    public function getCreatedAt();

    /**
     * Set Created At
     *
     * @param  [type] $created_at
     * @return CustomCartInterface
     */
    public function setCreatedAt($created_at);

    /**
     * Get Updated At
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * Set Updated At
     *
     * @param  [string] $updated_at
     * @return CustomCartInterface
     */
    public function setUpdatedAt($updated_at);
}
