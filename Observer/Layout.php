<?php

namespace Pmclain\LayoutDebug\Observer;

use Magento\Framework\Event\ObserverInterface;

class Layout implements ObserverInterface
{
    protected $layoutXml;

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Framework\View\Layout $layout */
        $layout = $observer->getLayout();
        $this->layoutXml = $layout->getXmlString();
    }

    public function getLayoutXml()
    {
        return $this->layoutXml;
    }
}
