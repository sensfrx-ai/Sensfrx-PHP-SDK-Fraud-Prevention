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
class ResetPasswordLogs
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function resetPasswordLog($resetPasswordEvent,$userId = NULL,$deviceId = NULL,$userExtras = array())
    {
        $method = "POST";
        $url = '/reset-password';
        $data = array(
            'ev'  => $resetPasswordEvent,
            'uID' => $userId,
            'dID' => $deviceId,
            'uex' => $userExtras
        );
        return $this->objAPI->callAPI($method, $url, $data);
    }

}