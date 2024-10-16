<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\Login;

use Sensfrx\Common\ApiCalls;
/**
 * Class Login
 *
 * @package Login
 */
class LoginLogs
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function loginLog($loginEvent,$userId = NULL,$deviceId = NULL,$userExtras = array())
    {
        $method = "POST";
        $url = '/login';
        $data = array(
            'ev'  => $loginEvent,
            'uID' => $userId,
            'dID' => $deviceId,
            'uex' => $userExtras
        );

        return $this->objAPI->callAPI($method, $url, $data);
    }

}