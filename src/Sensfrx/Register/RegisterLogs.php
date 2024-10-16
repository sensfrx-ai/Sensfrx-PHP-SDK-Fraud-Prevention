<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\Register;

use Sensfrx\Common\ApiCalls;
/**
 * Class Register
 *
 * @package Register
 */
class RegisterLogs
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function registerLog($registerEvent,$deviceId = NULL,$registerFields = array())
    {
        $method = "POST";
        $url = '/register';
        $data = array(
            'ev'  => $registerEvent,
            'dID' => $deviceId,
            'rfs' => $registerFields
        );

        return $this->objAPI->callAPI($method, $url, $data);
    }

}