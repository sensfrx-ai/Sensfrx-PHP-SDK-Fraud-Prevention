<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\Update;

use Sensfrx\Common\ApiCalls;
/**
 * Class Update
 *
 * @package Update
 */
class UpdateLogs
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function updateLog($updateEvent,$userId = NULL,$deviceId = NULL,$userExtras = array())
    {
        $method = "POST";
        $url = '/update-profile';
        $data = array(
            'ev'  => $updateEvent,
            'uID' => $userId,
            'dID' => $deviceId,
            'uex' => $userExtras
        );

        return $this->objAPI->callAPI($method, $url, $data);
    }

}