<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\Privacy;

use Sensfrx\Common\ApiCalls;
/**
 * Class Privacy
 *
 * @package Privacy
 */
class Privacy
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function getPrivacy()
    {
        $method = "GET";
        $url = '/privacy';
        return $this->objAPI->callAPI($method, $url);
    }

    public function postPrivacy($privacyInfo)
    {
        $method = "POST";
        $url = '/privacy';
        return $this->objAPI->callAPI($method, $url,$privacyInfo);
    }

}