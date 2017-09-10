<?php

namespace Pmclain\LayoutDebug\Plugin;

use Magento\Framework\App\Request\Http;

class Layout
{
    /** @var Http */
    protected $request;

    public function __construct(
        Http $request
    ) {
        $this->request = $request;
    }

    public function afterIsCacheable(\Magento\Framework\View\Layout $subject, $result)
    {
        if ($this->request->getParam('xml')) {
            return false;
        }

        return $result;
    }
}
