<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Task\Preorder\Test\Unit\Controller\Preorder;

use Magento\Contact\Controller\Index\Save;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\Request\HttpRequest;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;
use Magento\Framework\UrlInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Magento\Contact\Controller\Index\Post
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SaveTest extends TestCase
{
    /**
     * @var Post
     */
    private $controller;

    /**
     * @var RedirectFactory|MockObject
     */
    private $redirectResultFactoryMock;

    /**
     * @var Redirect|MockObject
     */
    private $redirectResultMock;

    /**
     * @var UrlInterface|MockObject
     */
    private $urlMock;

    /**
     * @var HttpRequest|MockObject
     */
    private $requestStub;

    /**
     * @var ManagerInterface|MockObject
     */
    private $messageManagerMock;

       /**
     * test setup
     */
    protected function setUp(): void
    {
        
        $contextMock = $this->createPartialMock(
            Context::class,
            ['getRequest', 'getResponse', 'getResultRedirectFactory', 'getUrl', 'getRedirect', 'getMessageManager']
        );
        $this->urlMock = $this->getMockForAbstractClass(UrlInterface::class);
        $this->messageManagerMock = $this->getMockForAbstractClass(ManagerInterface::class);
        $this->requestStub = $this->createPartialMock(
            Http::class,
            ['getPostValue', 'getParams', 'getParam', 'isPost']
        );

        $this->redirectResultMock = $this->createMock(Redirect::class);
        $this->redirectResultMock->method('setPath')->willReturnSelf();

        $this->redirectResultFactoryMock = $this->createPartialMock(
            RedirectFactory::class,
            ['create']
        );
        $this->redirectResultFactoryMock
            ->method('create')
            ->willReturn($this->redirectResultMock);

       

        $contextMock->expects($this->any())
            ->method('getRequest')
            ->willReturn($this->requestStub);
        $contextMock->expects($this->any())
            ->method('getResponse')
            ->willReturn($this->getMockForAbstractClass(ResponseInterface::class));
        $contextMock->expects($this->any())
            ->method('getMessageManager')
            ->willReturn($this->messageManagerMock);
        $contextMock->expects($this->any())
            ->method('getUrl')
            ->willReturn($this->urlMock);
        $contextMock->expects($this->once())
            ->method('getResultRedirectFactory')
            ->willReturn($this->redirectResultFactoryMock);

        $this->controller = (new ObjectManagerHelper($this))->getObject(
            Save::class,
            [
                'context' => $contextMock
                
            ]
        );
    }

    /**
     * Test ExecuteEmptyPost
     */
    
    /**
     * Test exceute post validation
     * @param array $postData
     * @param bool $exceptionExpected
     * @dataProvider postDataProvider
     */
   
    /**
     * Data provider for test exceute post validation
     */
    public function postDataProvider(): array
    {
        return [
            [['first_name' => null, 'last_name' => null, 'email' => '', 'quantity' => ''], true],
            [['first_name' => 'test', 'last_name' => '', 'email' => '', 'quantity' => ''], true],
            [['first_name' => '', 'last_name' => 'test', 'email' => '', 'quantity' => ''], true],
            [['first_name' => '', 'last_name' => '', 'email' => 'test', 'quantity' => ''], true],
            [['first_name' => '', 'last_name' => '', 'email' => '', 'quantity' => 'n'], true],
            [['first_name' => 'fname', 'last_name' => 'lname', 'email' => 'invalidmail', 'quantity' => 'n'], true],
        ];
    }

    /**
     * Test ExecuteValidPost
     */
    

    /**
     * Stub request for post data
     *
     * @param array $post
     */
    private function testExecute($post): void
    {
        $this->requestStub
            ->expects($this->once())
            ->method('isPost')
            ->willReturn(!empty($post));
        $this->requestStub->method('getPostValue')->willReturn($post);
        $this->requestStub->method('getParams')->willReturn($post);
        $this->requestStub->method('getParam')->willReturnCallback(
            function ($key) use ($post) {
                return $post[$key];
            }
        );
    }
}
