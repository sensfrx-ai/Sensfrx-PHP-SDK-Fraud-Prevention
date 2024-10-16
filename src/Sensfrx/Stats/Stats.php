<?php
/**
 * Sensfrx Main Class of App
 *
 */
namespace Sensfrx\Stats;

use Sensfrx\Common\ApiCalls;
/**
 * Class Stats
 *
 * @package Stats
 */
class Stats
{

    private $objAPI;
    
    function __construct($objAPI)
    {
        $this->objAPI = $objAPI;
    }

    public function getAtoStats($DateFilter)
    {
        $fromDate = $DateFilter['from_date'];
        $toDate = $DateFilter['to_date'];

        $method = "GET";
        $url = '/ato-stats?from_date=' . $fromDate . '&to_date=' . $toDate;
        return $this->objAPI->callAPI($method, $url);
    }

    public function getTransStats($DateFilter)
    {
        $fromDate = $DateFilter['from_date'];
        $toDate = $DateFilter['to_date'];
        
        $method = "GET";
        $url = '/trans-stats?from_date=' . $fromDate . '&to_date=' . $toDate;
        return $this->objAPI->callAPI($method, $url);
    }

}