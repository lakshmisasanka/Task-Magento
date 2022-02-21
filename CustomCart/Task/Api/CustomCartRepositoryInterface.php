<?php
namespace CustomCart\Task\Api;
/**
 * Undocumented interface
 */
interface CustomCartRepositoryInterface
{
    /**
     * Save CustomCart.
     *
     * @param \CustomCart\Task\Api\Data\CustomCartInterface $customCart
     * @return \CustomCart\Task\Api\Data\CustomCartInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\CustomCartInterface $customCart);

    /**
     * Retrieve customCart.
     *
     * @param string $customCartId
     * @return \CustomCart\Task\Api\Data\CustomCartInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($customCartId);

    /**
     * Retrieve customCarts matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \CustomCart\Task\Api\Data\customCartSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete customCart.
     *
     * @param \CustomCart\Task\Api\Data\CustomCartInterface $customCart
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\CustomCartInterface $customCart);

    /**
     * Delete customCart by ID.
     *
     * @param string $customCartId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($customCartId);
}
