<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\Rules;

use Sensfrx\Common\ApiCalls;
/**
 * Class Rules
 *
 * @package Rules
 */
class Rules
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function getRules()
    {
        $method = "GET";
        $url = '/rules';

        return $this->objAPI->callAPI($method, $url);
    }

    public function postRules($rulesInfo)
    {
        $method = "POST";
        $url = '/rules';

        return $this->objAPI->callAPI($method, $url,$rulesInfo);
    }

}