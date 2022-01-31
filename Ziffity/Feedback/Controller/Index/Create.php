<?php
namespace Ziffity\Feedback\Controller\Index;

use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Ziffity\Feedback\Model\FeedbackFactory;
use Ziffity\Feedback\Helper\Sendmail;

class Create extends Action\Action
{
    /** @var PageFactory */
    protected $_pageFactory;

    /** @var FeedbackFactory */
    protected $_feedbackFactory;

    /** @var Sendmail */
    protected $mailer;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        FeedbackFactory $feedbackFactory,
        Sendmail $mailer
    )
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_feedbackFactory = $feedbackFactory;
        $this->mailer = $mailer;
    }

    public function execute()
    {
        $page   = $this->_pageFactory->create();
        $post   = (array) $this->getRequest()->getPost();
        if($post) {

            if ($this->submit($post) && $this->mailer->sendMail("feedback_notification_template" , $post)) {
                $this->messageManager->addSuccess(__('Thanks for giving us your valuable feedback! Confirmation email has sent to your registered email id.'));
                $this->_redirect('/');

            }
        }

        return $page;

    }

    /**
     * Form Submission
     * @param $post
     * @return bool
     */

    private function submit($post)
    {
        try {
            $form = $this->_feedbackFactory->create();
            $form->addData($post)
                ->save();
            return true;
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong! Your feedback has not submitted. Please try again.'));
        }

        return false;
    }

}
