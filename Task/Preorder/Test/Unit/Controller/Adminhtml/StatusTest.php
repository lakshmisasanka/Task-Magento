<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Task\Preorder\Test\Unit\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context as BackendContext;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Task\Preorder\Controller\Adminhtml\Index\Status;
use Task\Preorder\Model\PreorderFactory;
use Task\Preorder\Model\ResourceModel\Preorder\CollectionFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\Manager;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;
use Magento\Ui\Component\MassAction\Filter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Task\Preorder\Helper\SendEmail;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class StatusTest extends TestCase
{
    /**
     * @var MassAssignGroup
     */
    protected $status;

    /**
     * @var Context|MockObject
     */
    protected $contextMock;

    /**
     * @var Redirect|MockObject
     */
    protected $resultRedirectMock;

    /**
     * @var Http|MockObject
     */
    protected $requestMock;

    /**
     * @var ResponseInterface|MockObject
     */
    protected $responseMock;

    /**
     * @var Manager|MockObject
     */
    protected $messageManagerMock;

    /**
     * @var \Magento\Framework\ObjectManager\ObjectManager|MockObject
     */
    protected $objectManagerMock;

    /**
     * @var Collection|MockObject
     */
    protected $PreorderMock;

    /**
     * @var CollectionFactory|MockObject
     */
    protected $CollectionFactoryMock;

    /**
     * @var Filter|MockObject
     */
    protected $filterMock;

    /**
     * @var SendEmail|MockObject
     */
    private $mailMock;


    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        $objectManagerHelper = new ObjectManagerHelper($this);

        $this->contextMock = $this->createMock(BackendContext::class);
        $resultRedirectFactory = $this->createMock(
            RedirectFactory::class
        );
        $this->mailMock = $this->getMockBuilder(SendEmail::class)
        ->getMockForAbstractClass();

        $this->responseMock = $this->getMockForAbstractClass(ResponseInterface::class);
        $this->requestMock = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->objectManagerMock = $this->createPartialMock(
            \Magento\Framework\ObjectManager\ObjectManager::class,
            ['create']
        );
        $this->messageManagerMock = $this->createMock(Manager::class);
        $this->PreorderMock =
            $this->getMockBuilder(Collection::class)
                ->disableOriginalConstructor()
                ->getMock();
        $this->CollectionFactoryMock =
            $this->getMockBuilder(CollectionFactory::class)
                ->disableOriginalConstructor()
                ->setMethods(['create'])
                ->getMock();
        $redirectMock = $this->getMockBuilder(Redirect::class)
            ->disableOriginalConstructor()
            ->getMock();
        $resultFactoryMock = $this->getMockBuilder(ResultFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $resultFactoryMock->expects($this->any())
            ->method('create')
            ->with(ResultFactory::TYPE_REDIRECT)
            ->willReturn($redirectMock);

        $this->resultRedirectMock = $this->getMockBuilder(Redirect::class)
            ->disableOriginalConstructor()
            ->getMock();

        $resultRedirectFactory->expects($this->any())->method('create')->willReturn($this->resultRedirectMock);

        $this->contextMock->expects($this->once())->method('getMessageManager')->willReturn($this->messageManagerMock);
        $this->contextMock->expects($this->once())->method('getRequest')->willReturn($this->requestMock);
        $this->contextMock->expects($this->once())->method('getResponse')->willReturn($this->responseMock);
        $this->contextMock->expects($this->once())->method('getObjectManager')->willReturn($this->objectManagerMock);
        $this->contextMock->expects($this->any())
            ->method('getResultRedirectFactory')
            ->willReturn($resultRedirectFactory);
        $this->contextMock->expects($this->any())
            ->method('getResultFactory')
            ->willReturn($resultFactoryMock);

        $this->filterMock = $this->createMock(Filter::class);
        $this->filterMock->expects($this->once())
            ->method('getCollection')
            ->with($this->PreorderMock)
            ->willReturnArgument(0);
        $this->CollectionFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($this->PreorderMock);
        
        $this->status = $objectManagerHelper->getObject(
            Status::class,
            [
                'context' => $this->contextMock,
                'filter' => $this->filterMock,
                'collectionFactory' => $this->CollectionFactoryMock,
                'mail' => $this->mailMock
               
            ]
        );
    }

    /**
     * Unit test to verify mass customer group assignment use case
     *
     * @throws LocalizedException
     */
    public function testExecute()
    {
        $feedbackIds = [1,2,3];
        $preorderMock = $this->getMockBuilder(Status::class)
            ->setMethods(['setData'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        

        $this->messageManagerMock->expects($this->once())
            ->method('addSuccessMessage')
            ->with(__('A total of %1 record(s) were updated.', count($feedbackIds)));

        $this->resultRedirectMock->expects($this->any())
            ->method('setPath')
            ->with('preorder/*/index')
            ->willReturnSelf();

        $this->status->execute();
    }

    /**
     * Unit test to verify expected error during mass customer group assignment use case
     *
     * @throws LocalizedException
     */
    public function testExecuteWithException()
    {
        $feedbackIds = [1,2,3];

         $this->messageManagerMock->expects($this->once())
            ->method('addErrorMessage')
            ->with('Some message.');

        $this->status->execute();
    }
}
