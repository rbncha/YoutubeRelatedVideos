<?php

/**
 * This code file is part of Rbncha_Main module
 * Use of this part of code is prohibited by and 
 * anywhere else than I myself or by my written 
 * permission.
 *  
 * @author Rubin Shrestha <rubin.sth@gmail.com>
 */

namespace Rbncha\Main\Helper;

use Exception;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\DataObjectFactory;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Helper\Context;
use Rbncha\Main\Model\Config;

class Youtube extends AbstractHelper
{

    protected $curlClient;
    protected $apiKey;
    protected $dataObjectFactory;
    protected $cache;
    protected $serializer;
    protected $cacheIdentifier;
    protected $url;
    protected $rConfig;

    /**
     * @param integer $maxResult number of videos to fetch
     */
    protected $maxResult;

        
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        Context $context,
        Curl $curlClient,
        DataObjectFactory $dataObjectFactory,
        CacheInterface $cache,
        Json $serializer,
        UrlInterface $urlInterface,
        Config $rConfig
    ) {
        parent::__construct($context);

        $this->dataObjectFactory = $dataObjectFactory;
        $this->cache = $cache;
        $this->serializer = $serializer;
        $this->url = $urlInterface;
        $this->rConfig = $rConfig;
        $this->curlClient = $curlClient;

        $currentUrl = hash('sha256', $this->url->getCurrentUrl());
        $this->cacheIdentifier = 'rbncha_youtube_cache-'.$currentUrl;

        $this->apiKey = $this->rConfig->getYoutubeApiKey();
        $this->maxResult = $this->rConfig->getYoutubeApiMaxResult();
    }
        
    /**
     * getRelatedVideos
     *
     * @param  mixed $videoId
     * @return array
     */
    public function getRelatedVideos($videoId): array
    {
        $endpoint = "https://www.googleapis.com/youtube/v3/search";
        $url = sprintf(
            "%s?part=snippet&relatedToVideoId=%s&type=video&maxResults=%s&key=%s",
            $endpoint,
            $videoId,
            $this->maxResult,
            $this->apiKey
        );

        try {
            $this->curlClient->get($url);
            $response = $this->curlClient->getBody();
            $data = json_decode($response, true);

            if (isset($data['items'])) {
                return $data['items'];
            }
        } catch (\Exception $e) {
            return ['error' => 'Unable to fetch data: ' . $e->getMessage()];
        }

        return [];
    }
        
    /**
     * getPopularVideos
     *
     * @param  mixed $region
     * @return array
     */
    public function getPopularVideos($region = 'US'): array
    {
        $endpoint = "https://www.googleapis.com/youtube/v3/videos";
        $url = sprintf(
            "%s?part=snippet&chart=mostPopular&regionCode=%s&maxResults=%s&key=%s",
            $endpoint,
            $region,
            $this->maxResult,
            $this->apiKey
        );

        try {
            $this->curlClient->get($url);
            $response = $this->curlClient->getBody();
            $data = json_decode($response, true);

            if (isset($data['items'])) {
                return $data['items'];
            }
        } catch (\Exception $e) {
            return ['error' => 'Unable to fetch data: ' . $e->getMessage()];
        }

        return [];
    }
    
    /**
     * getSearchVideos
     *
     * @param  mixed $search
     * @return array
     */
    public function getSearchVideos($search): array
    {
        $data = $this->cache->load($this->cacheIdentifier);

        if(!empty($data)){
            $data = $this->serializer->unserialize($data);
            return $data;
        }

        $endpoint = "https://www.googleapis.com/youtube/v3/search";
        $url = sprintf(
            "%s?part=snippet&q=%s&maxResults=%s&key=%s&type=video",
            $endpoint,
            urlencode($search),
            $this->maxResult,
            $this->apiKey
        );

        try {
            $this->curlClient->get($url);
            $response = $this->curlClient->getBody();
            $data = json_decode($response, true);

            if (isset($data['items'])) {
                $cacheData = $this->serializer->serialize($data['items']);
                $this->cache->save($cacheData, $this->cacheIdentifier, [], $this->rConfig->getYoutubeApiCacheLifetime());
                
                return $data['items'];
            }
        } catch (\Exception $e) {

            return ['error' => 'Unable to fetch data: ' . $e->getMessage()];
        }

        return [];
    }
}
