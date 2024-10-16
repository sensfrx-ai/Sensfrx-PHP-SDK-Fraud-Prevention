<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\Profile;

use Sensfrx\Common\ApiCalls;
/**
 * Class Profile
 *
 * @package Profile
 */
class Profile
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function getProfile()
    {
        $method = "GET";
        $url = '/profile';

        return $this->objAPI->callAPI($method, $url);
    }

    public function postProfile($profileInfo)
    {
        $method = "POST";
        $url = '/profile';

        return $this->objAPI->callAPI($method, $url,$profileInfo);
    }

}