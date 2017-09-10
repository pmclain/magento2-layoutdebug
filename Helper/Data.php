<?php

namespace Pmclain\LayoutDebug\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\State;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /** @var \Magento\Framework\App\State */
    protected $state;

    protected $enabled = null;

    public function __construct(
        Context $context,
        State $state
    ) {
        parent::__construct($context);
        $this->state = $state;
    }

    public function isEnabled()
    {
        if (is_null($this->enabled)) {
            $this->enabled = $this->state->getMode() === State::MODE_DEVELOPER;
        }

        return $this->enabled;
    }
}
