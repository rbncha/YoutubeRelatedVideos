<?php

/**
 * This code file is part of Rbncha_Main module
 * Use of this part of code is prohibited by and 
 * anywhere else than I myself or by my written 
 * permission.
 *  
 * @author Rubin Shrestha <rubin.sth@gmail.com>
 */

namespace Rbncha\Main\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Config
 */
class Config
{  
    public const XML_PATH_RBNCHA_YOUTUBEAPI_ENABLED = 'rbncha_youtube/youtube/enabled';
    public const XML_PATH_RBNCHA_YOUTUBEAPI_API_KEY = 'rbncha_youtube/youtube/api_key';
    public const XML_PATH_RBNCHA_YOUTUBEAPI_MAX_RESULT = 'rbncha_youtube/youtube/max_result';
    public const XML_PATH_RBNCHA_YOUTUBEAPI_CACHE_LIFETIME = 'rbncha_youtube/youtube/cache_lifetime';

    public function __construct(protected ScopeConfigInterface $scopeConfig)
    {}

    
    /**
     * isYoutubeApiEnabled
     *
     * @param  mixed $storeId
     * @return bool
     */
    public function isYoutubeApiEnabled($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_RBNCHA_YOUTUBEAPI_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

        
    /**
     * getYoutubeApiKey
     *
     * @param  mixed $storeId
     * @return string
     */
    public function getYoutubeApiKey($storeId = null): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_RBNCHA_YOUTUBEAPI_API_KEY,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

        
    /**
     * getYoutubeApiMaxResult
     *
     * @param  mixed $storeId
     * @return string
     */
    public function getYoutubeApiMaxResult($storeId = null): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_RBNCHA_YOUTUBEAPI_MAX_RESULT,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

       
    /**
     * getYoutubeApiCacheLifetime
     *
     * @param  mixed $storeId
     * @return string
     */
    public function getYoutubeApiCacheLifetime($storeId = null): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_RBNCHA_YOUTUBEAPI_CACHE_LIFETIME,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}