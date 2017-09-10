<?php

namespace Pmclain\LayoutDebug\Plugin;

use Magento\Framework\App\Request\Http;
use Pmclain\LayoutDebug\Helper\Data;

class Layout
{
    /** @var Http */
    protected $request;

    /** @var Data */
    protected $helper;

    public function __construct(
        Http $request,
        Data $helper
    ) {
        $this->request = $request;
        $this->helper = $helper;
    }

    public function afterIsCacheable(\Magento\Framework\View\Layout $subject, $result)
    {
        if ($this->helper->isEnabled() && $this->request->getParam('xml')) {
            return false;
        }

        return $result;
    }
}
