<?php
/**
 * This code file is part of Rbncha_Main module
 * Use of this part of code is prohibited by and 
 * anywhere else than I myself or by my written 
 * permission.
 *  
 * @author Rubin Shrestha <rubin.sth@gmail.com>
 */

namespace Rbncha\Main\Block;

use Magento\Framework\View\Element\Template;
use Rbncha\Main\Helper\Youtube;
use Rbncha\Main\Helper\PopularVideos;

/**
 * RelatedVideos
 */
class RelatedVideos extends Template
{  
    /**
     * youtubeHelper
     *
     * @var mixed
     */
    protected $youtubeHelper;    
    /**
     * popularVideos
     *
     * @var mixed
     */
    protected $popularVideos;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        Template\Context $context,
        Youtube $youtubeHelper,
        PopularVideos $popularVideos,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->youtubeHelper = $youtubeHelper;
        $this->popularVideos = $popularVideos;
    }
    
    /**
     * getRelatedVideos 
     *
     * @param  mixed $videoId
     * @return array
     */
    public function getRelatedVideos($videoId): array
    {
        return $this->youtubeHelper->getRelatedVideos($videoId);
    }
    
    /**
     * getPopularVideos
     *
     * @param  mixed $region
     * @return array
     */
    public function getPopularVideos($region = null): array
    {
        return $this->popularVideos->getPopularVideos($region);
    }
    
    /**
     * getSearchVideos
     *
     * @param  mixed $search
     * @return array
     */
    public function getSearchVideos($search): array
    {
        $list = $this->youtubeHelper->getSearchVideos($search);

        //exit('++++++<pre>'.print_r($list,true));
        return $list;
    }
}