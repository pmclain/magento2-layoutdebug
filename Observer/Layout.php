<?php

namespace Pmclain\LayoutDebug\Observer;

use Magento\Framework\Event\ObserverInterface;
use Pmclain\LayoutDebug\Helper\Data;

class Layout implements ObserverInterface
{
    /** @var string */
    protected $layoutXml;

    /** @var Data */
    protected $helper;

    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->helper->isEnabled()) {
            return;
        }

        /** @var \Magento\Framework\View\Layout $layout */
        $layout = $observer->getLayout();
        $this->layoutXml = $layout->getXmlString();
    }

    public function getLayoutXml()
    {
        return $this->layoutXml;
    }
}
