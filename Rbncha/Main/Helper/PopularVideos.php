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
use Rbncha\Main\Helper\Youtube;

/**
 * PopularVideos
 */
class PopularVideos extends AbstractHelper
{
    protected $helper;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        Youtube $helper
    ){
        parent::__construct($context);
        $this->helper = $helper;
    }
    
    /**
     * getPopularVideos
     *
     * @param  mixed $region
     * @return array
     */
    public function getPopularVideos($region = null): array
    {
        return $this->helper->getPopularVideos($region);
    }

}