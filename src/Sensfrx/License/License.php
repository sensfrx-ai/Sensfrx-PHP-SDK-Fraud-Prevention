<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\License;

use Sensfrx\Common\ApiCalls;
/**
 * Class License
 *
 * @package License
 */
class License
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function getLicense()
    {
        $method = "GET";
        $url = '/license';

        return $this->objAPI->callAPI($method, $url);
    }

}