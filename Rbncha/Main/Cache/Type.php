<?php
/**
 * This code file is part of Rbncha_Main module
 * Use of this part of code is prohibited by and 
 * anywhere else than I myself or by my written 
 * permission.
 *  
 * @author Rubin Shrestha <rubin.sth@gmail.com>
 */

namespace Rbncha\Main\Cache;

use Magento\Framework\App\Cache\StateInterface;
use Magento\Framework\App\Cache\Type\FrontendPool;

class Type extends \Magento\Framework\Cache\Frontend\Decorator\TagScope
{
    const TYPE_IDENTIFIER = 'RBNCHA_CACHE_TYPE';
    const CACHE_TAG = 'RBNCHA_YOUTUBE_VIDEO';
    private $cacheState;

    public function __construct(
        FrontendPool $cacheFrontendPool,
        StateInterface $cacheState
    ) {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
        $this->cacheState = $cacheState;
    }
    public function load($identifier)
    {
        if (!$this->isEnabled()) {
            return false;
        }
        return parent::load($identifier);
    }

    public function save($data, $identifier, array $tags = [], $lifeTime = null)
    {
        if (!$this->isEnabled()) {
            return false;
        }
        return parent::save($data, $identifier, $tags, $lifeTime);
    }

    public function isEnabled()
    {
        return $this->cacheState->isEnabled(self::TYPE_IDENTIFIER);
    }
}