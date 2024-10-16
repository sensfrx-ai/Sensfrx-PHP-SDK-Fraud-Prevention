<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\Bot;

use Sensfrx\Common\ApiCalls;
/**
 * Class Bot
 *
 * @package Bot
 */
class Bot
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function botLog($deviceId = NULL,$userId = NULL)
    {
        $method = "POST";
        $url = '/bot';
        $data = array(
            'uID' => $userId,
            'dID' => $deviceId,
        );

        return $this->objAPI->callAPI($method, $url, $data);
    }


}