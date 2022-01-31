<?php
declare(strict_types=1);

namespace Ziffity\Feedback\Ui\Component\Listing\Grid\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;


class Action extends Column
{
    const FEEDBACK_CUSTOMER_PATH_APPROVE = 'feedback/view/accept';
    const FEEDBACK_CUSTOMER_PATH_DECLINE = 'feedback/view/decline';
    const FEEDBACK_CUSTOMER_PATH_VIEW = 'feedback/view/review';

    
    private $urlBuilder;

    
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['feedback_id'])) {
                    
                    $item[$name]['approve'] = [
                        'href' => $this->urlBuilder->getUrl(
                            self::FEEDBACK_CUSTOMER_PATH_APPROVE,
                            ['id' => $item['feedback_id']]
                        ),
                        'label' => __('Approve'),
                       'confirm' => [
                            'title' => __('Set as Approve'),
                            'message' => __('Are you sure you want to approve?')
                        ]
                    ];

                    $item[$name]['decline'] = [
                        'href' => $this->urlBuilder->getUrl(
                            self::FEEDBACK_CUSTOMER_PATH_DECLINE,
                            ['id' => $item['feedback_id']]
                        ),
                        'label' => __('Decline'),
                        'confirm' => [
                            'title' => __('Set as Decline'),
                            'message' => __('Are you sure you want to decline?')
                        ]
                    ];

                    $item[$name]['view'] = [
                        'href' => $this->urlBuilder->getUrl(
                            self::FEEDBACK_CUSTOMER_PATH_VIEW,
                            ['id' => $item['feedback_id']]
                        ),
                        'label' => __('View')
                        
                    ];
                }
            }
        }

        return $dataSource;
    }
}
