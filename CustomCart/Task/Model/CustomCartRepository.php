<?php

namespace CustomCart\Task\Model;

use CustomCart\Task\Api\CustomCartRepositoryInterface;
use CustomCart\Task\Api\Data;
use CustomCart\Task\Model\ResourceModel\CustomCart as ResourceCustomCart;
use CustomCart\Task\Model\ResourceModel\CustomCart\CollectionFactory as CustomCartCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;



class CustomCartRepository implements CustomCartRepositoryInterface
{
   
    protected $resource;

   
    protected $customCartFactory;

    
    protected $customCartCollectionFactory;

   
    protected $searchResultsFactory;

   
    protected $dataObjectHelper;

   
    protected $dataObjectProcessor;

   
    protected $dataCustomCartFactory;

    
    private $collectionProcessor;

  

  
    public function __construct(
        ResourceCustomCart $resource,
        CustomCartFactory $customCartFactory,
        \CustomCart\Task\Api\Data\CustomCartInterfaceFactory $dataCustomCartFactory,
        CustomCartCollectionFactory $customCartCollectionFactory,
        Data\CustomCartSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor 
    ) {
        $this->resource = $resource;
        $this->customCartFactory = $customCartFactory;
        $this->customCartCollectionFactory = $customCartCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomCartFactory = $dataCustomCartFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionProcessor = $collectionProcessor; 
    }

   
    public function save(Data\CustomCartInterface $customCart)
    {
       
        try {
            $this->resource->save($customCart);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $customCart;
    }

   
    public function getById($customCartId)
    {
        $customCart = $this->customCartFactory->create();
        $this->resource->load($customCart, $customCartId);
        if (!$customCart->getCustomCartId()) {
            throw new NoSuchEntityException(__('The CustomCart with the "%1" ID doesn\'t exist.', $CustomCartId));
        }
        return $customCart;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
         $collection = $this->customCartCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setItems($collection->getItems());
        return  $searchResults ;
    }

    
    public function delete(Data\CustomCartInterface $customCart)
    {
        try {
            $this->resource->delete($customCart);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    
    public function deleteById($customCartId)
    {
        return $this->delete($this->getById($customCartId));
    }

  
}
