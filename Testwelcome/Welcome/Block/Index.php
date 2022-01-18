<?php
namespace Testwelcome\Welcome\Block;
 
class Index extends \Magento\Framework\View\Element\Template
{
    public function getWelcome()
    {
        return 'Welcome To Magento 2!';
    }
}