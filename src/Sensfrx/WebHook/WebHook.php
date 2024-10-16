<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\WebHook;

use Sensfrx\Common\ApiCalls;
/**
 * Class WebHook
 *
 * @package WebHook
 */
class WebHook
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function addWebHook($webhookURL)
    {
        $method = "POST";
        $url = '/webhooks';
        $data = array(
            'url'  => $webhookURL
        );

        return $this->objAPI->callAPI($method, $url, $data);
    }

}