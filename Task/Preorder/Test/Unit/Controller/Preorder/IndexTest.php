<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Task\Preorder\Test\Unit\Controller\Preorder;

use Task\Preorder\Controller\Preorder\Index;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\PageFactory;
use Magento\Framework\Controller\PageInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;
use Magento\Framework\UrlInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Magento\Contact\Controller\Index\Index
 */
class IndexTest extends TestCase
{
    /**
     * @var Index
     */
    private $controller;

   
    /**
     * @var ResultFactory|MockObject
     */
    private $pageFactoryMock;

    /**
     * @var UrlInterface|MockObject
     */
    private $urlMock;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        
        $contextMock = $this->getMockBuilder(Context::class)
            ->setMethods(
                ['getRequest', 'getResponse', 'getResultFactory', 'getUrl']
            )->disableOriginalConstructor(
            )->getMock();

        $this->urlMock = $this->getMockBuilder(UrlInterface::class)
            ->getMockForAbstractClass();

        $contextMock->expects($this->any())
            ->method('getUrl')
            ->willReturn($this->urlMock);

        $contextMock->expects($this->any())
            ->method('getRequest')
            ->willReturn($this->getMockBuilder(RequestInterface::class)
            ->getMockForAbstractClass());

        $contextMock->expects($this->any())
            ->method('getResponse')
            ->willReturn($this->getMockBuilder(ResponseInterface::class)
            ->getMockForAbstractClass());

        $this->pageFactoryMock = $this->getMockBuilder(ResultFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $contextMock->expects($this->once())
            ->method('getPageFactory')
            ->willReturn($this->resultFactoryMock);

        $this->controller = (new ObjectManagerHelper($this))->getObject(
            Index::class,
            [
                'context' => $contextMock
            ]
        );
    }

    /**
     * Test Execute Method
     */
    public function testExecute(): void
    {
        $resultStub = $this->getMockForAbstractClass(PageInterface::class);
        $this->resultFactoryMock->expects($this->once())
            ->method('create')
            ->with(PageFactory::TYPE_PAGE)
            ->willReturn($resultStub);
        
        $this->assertSame($resultStub, $this->controller->execute());
    }
}
