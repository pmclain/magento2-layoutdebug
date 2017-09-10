<?php

namespace Pmclain\LayoutDebug\Observer;

use Magento\Framework\Event\ObserverInterface;

class Response implements ObserverInterface
{
    protected $layoutObserver;

    public function __construct(
        Layout $layoutObserver
    ) {
        $this->layoutObserver = $layoutObserver;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
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
            $debug = 'me';
        }
    }
}
