<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\Shadow;

use Sensfrx\Common\ApiCalls;
/**
 * Class Shadow
 *
 * @package Shadow
 */
class Shadow
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function getShadow()
    {
        $method = "GET";
        $url = '/shadow';
        return $this->objAPI->callAPI($method, $url);
    }

    public function postShadow($shadowInfo)
    {
        $method = "POST";
        $url = '/shadow';
        return $this->objAPI->callAPI($method, $url,$shadowInfo);
    }

}