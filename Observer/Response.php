<?php

namespace Pmclain\LayoutDebug\Observer;

use Magento\Framework\Event\ObserverInterface;
use Pmclain\LayoutDebug\Helper\Data;

class Response implements ObserverInterface
{
    /** @var Layout */
    protected $layoutObserver;

    /** @var Data */
    protected $helper;

    public function __construct(
        Layout $layoutObserver,
        Data $helper
    ) {
        $this->layoutObserver = $layoutObserver;
        $this->helper = $helper;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->helper->isEnabled()) {
            return;
        }

        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $observer->getRequest();
        if ($request->getParam('xml')) {
            /** @var \Magento\Framework\App\Response\Http $response */
            $response = $observer->getResponse();
            $response->setHeader('Content-type', 'application/xml', true);
            //Extremely hacky, but a quick fix to render the output directly in browser
            $layout = str_replace(
                '<layout>',
                '<layout xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">',
                $this->layoutObserver->getLayoutXml()
            );
            $response->setContent('<?xml version="1.0" encoding="UTF-8" ?>' . $layout);
        }
    }
}
