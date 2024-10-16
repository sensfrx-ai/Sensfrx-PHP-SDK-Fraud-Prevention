<?php
/**
 *  Sensfrx Main Class of App
 *
 */

namespace Sensfrx;

use Sensfrx\Login\LoginLogs;
use Sensfrx\Transaction\TransactionLogs;
use Sensfrx\Login\ResetPasswordLogs;
use Sensfrx\Update\UpdateLogs;
use Sensfrx\Register\RegisterLogs;
use Sensfrx\Common\ApiCalls;
use Sensfrx\Common\ErrorMessage;
use Sensfrx\Device\DeviceManage;
use Sensfrx\Profile\Profile;
use Sensfrx\Privacy\Privacy;
use Sensfrx\Plugin\Plugin;
use Sensfrx\Shadow\Shadow;
use Sensfrx\Stats\Stats;
use Sensfrx\Alerts\Alerts;
use Sensfrx\License\License;
use Sensfrx\Rules\Rules;
use Sensfrx\Bot\Bot;
use Sensfrx\WebHook\WebHook;


/**
 * Class Sensfrx
 *
 * @package Sensfrx
 */
class Sensfrx
{
    /**
     * @const string Version number of the Sensfrx PHP SDK.
     */
    const VERSION = '1.2.0';

    /**
     * @const string The name of the environment variable that contains the app ID.
     */
    const APP_ID_ENV_NAME = 'AUTHSAFE_APP_ID';

    /**
     * @const string The name of the environment variable that contains the app secret.
     */
    const APP_SECRET_ENV_NAME = 'AUTHSAFE_APP_SECRET';

    /**
     * @const string The name of the environment variable that contains the app secret.
     */
    //const APP_API_URL = 'https://pixel.Sensfrx.ai';

    /**
     * @var SensfrxApp The SensfrxApp entity.
     */
    protected $app;

    /**
     * Instantiates a new Sensfrx super-class object.
     *
     * @param array $config
     *
     * @throws SensfrxSDKException
     */
    public $loginLog;
    public $transactionLog;
    public $resetPasswordLog;
    public $updateLog;
    public $registerLog;
    public $ProfileObj;
    public $PrivacyObj;
    public $PluginObj;
    public $ShadowObj;
    public $StatsObj;
    public $AlertsObj;
    public $LicenseObj;
    public $RulesObj;
    public $botLog;
    public $deviceManage;
    public $webHook;
    public $objAPI;
    public $apiUrl;

    public function __construct(array $config = [])
    {
        $msg = array();
        $a = new ErrorMessage();
        $this->apiUrl = 'https://a.Sensfrx.ai/v1';
        //$this->apiUrl = 'http://127.0.0.1:5000';
        $config = array_merge([
            'property_id' => getenv(static::APP_ID_ENV_NAME),
            'property_secret' => getenv(static::APP_SECRET_ENV_NAME),
            'api_url' => $this->apiUrl
        ], $config);
        $this->objAPI = new ApiCalls($config['property_id'],$config['property_secret'],$config['api_url']);
        $this->loginLog = new LoginLogs($this->objAPI);
        $this->transactionLog = new TransactionLogs($this->objAPI);
        $this->resetPasswordLog = new ResetPasswordLogs($this->objAPI);
        $this->updateLog = new UpdateLogs($this->objAPI);
        $this->registerLog = new RegisterLogs($this->objAPI);
        $this->ProfileObj = new Profile($this->objAPI);
        $this->PrivacyObj = new Privacy($this->objAPI);
        $this->PluginObj = new Plugin($this->objAPI);
        $this->ShadowObj = new Shadow($this->objAPI);
        $this->StatsObj = new Stats($this->objAPI);
        $this->AlertsObj = new Alerts($this->objAPI);
        $this->LicenseObj = new License($this->objAPI);
        $this->RulesObj = new Rules($this->objAPI);
        $this->botLog = new Bot($this->objAPI);
        $this->deviceManage = new DeviceManage($this->objAPI);
        $this->webHook = new WebHook($this->objAPI);

        if(empty($config['property_id']) || !isset($config['property_id']))
        {
            $msg['status'] = "error";
            $erno = 0;
            $msg['message'] = $a->errormsg($erno);
            return $msg;
        }

        if(empty($config['property_secret']) || !isset($config['property_secret']))
        {
            $msg['status'] = "error";
            $erno = 0;
            $msg['message'] = $a->errormsg($erno);
            return $msg;
        }

    }

    public function loginAttempt($loginEvent,$userId = NULL,$deviceId = NULL,$userExtras = array())
    {
        $b = new ErrorMessage();

        if(empty($loginEvent) || !isset($loginEvent))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(($loginEvent == 'login_success') && (empty($userId) || !isset($userId)))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }

        return $this->loginLog->loginLog($loginEvent,$userId,$deviceId,$userExtras);
    }

    public function transactionAttempt($transactionEvent,$deviceId = NULL,$transactionExtras = array())
    {
        $b = new ErrorMessage();

        if(empty($transactionEvent) || !isset($transactionEvent))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        return $this->transactionLog->transactionLog($transactionEvent,$deviceId,$transactionExtras);
    }

    public function registerAttempt($registerEvent,$deviceId = NULL,$registerFields = array())
    {
        $b = new ErrorMessage();

        if(empty($registerEvent) || !isset($registerEvent))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(count($registerFields) == 0)
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }

        return $this->registerLog->registerLog($registerEvent,$deviceId,$registerFields);
    }

    public function passwordResetAttempt($resetPasswordEvent,$userId = NULL,$deviceId = NULL,$userExtras = array())
    {
        $b = new ErrorMessage();

        if(empty($resetPasswordEvent) || !isset($resetPasswordEvent))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(($resetPasswordEvent == 'reset_password_success') && (empty($userId) || !isset($userId)))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }

        return $this->resetPasswordLog->resetPasswordLog($resetPasswordEvent,$userId,$deviceId,$userExtras);

    }

    public function updateAttempt($updateEvent,$userId = NULL,$deviceId = NULL,$userExtras = array())
    {
        $b = new ErrorMessage();

        if(empty($updateEvent) || !isset($updateEvent))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }

        return $this->updateLog->updateLog($updateEvent,$userId,$deviceId,$userExtras);
    }

    public function approveDevice($deviceId)
    {
        $b = new ErrorMessage();

        if(empty($deviceId) || !isset($deviceId))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }

        return $this->deviceManage->deviceManage($deviceId, "approve");
    }

    public function denyDevice($deviceId)
    {
        $b = new ErrorMessage();

        if(empty($deviceId) || !isset($deviceId))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }

        return $this->deviceManage->deviceManage($deviceId, "deny");
    }

    public function getUserDevices($userId)
    {
        $b = new ErrorMessage();

        if(empty($userId) || !isset($userId))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }

        return $this->deviceManage->getUserDevices($userId);
    }

    public function addWebHook($url)
    {
        $b = new ErrorMessage();

        if(empty($url) || !isset($url))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if (!filter_var($url, FILTER_VALIDATE_URL))
        {
            $msg['status'] = "error";
            $erno = 3;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }

        return $this->webHook->addWebHook($url);
    }

    public function getprofileinfo()
    {
        return $this->ProfileObj->getProfile();
    }

    public function postprofileinfo($EditFields = array())
    {
        $b = new ErrorMessage();
        if(empty($EditFields) || !isset($EditFields))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(count($EditFields) == 0)
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        return $this->ProfileObj->postProfile($EditFields);
    }
    public function getalertsinfo()
    {
        return $this->AlertsObj->getAlerts();
    }

    public function postalertsinfo($EditFields = array())
    {
        $b = new ErrorMessage();
        if(empty($EditFields) || !isset($EditFields))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(count($EditFields) == 0)
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        return $this->AlertsObj->postAlerts($EditFields);
    }
    public function getprivacyinfo()
    {
        return $this->PrivacyObj->getPrivacy();
    }

    public function postprivacyinfo($EditFields = array())
    {
        $b = new ErrorMessage();
        if(empty($EditFields) || !isset($EditFields))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(count($EditFields) == 0)
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        return $this->PrivacyObj->postPrivacy($EditFields);
    }

    public function integrateplugininfo($Fields = array())
    {
        $b = new ErrorMessage();
        if(empty($Fields) || !isset($Fields))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(count($Fields) == 0)
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        return $this->PluginObj->integratePlugin($Fields);
    }

    public function uninstallplugininfo($Fields = array())
    {
        $b = new ErrorMessage();
        if(empty($Fields) || !isset($Fields))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(count($Fields) == 0)
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        return $this->PluginObj->uninstallPlugin($Fields);
    }

    public function getshadowinfo()
    {
        return $this->ShadowObj->getShadow();
    }

    public function postshadowinfo($EditFields = array())
    {
        $b = new ErrorMessage();
        if(empty($EditFields) || !isset($EditFields))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(count($EditFields) == 0)
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        return $this->ShadowObj->postShadow($EditFields);
    }

    public function getlicenseinfo()
    {
        return $this->LicenseObj->getLicense();
    }

    public function getrulesinfo()
    {
        return $this->RulesObj->getRules();
    }

    public function postrulesinfo($EditFields = array())
    {
        $b = new ErrorMessage();

        if(empty($EditFields) || !isset($EditFields))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(count($EditFields) == 0)
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        return $this->RulesObj->postRules($EditFields);
    }

    public function isBot($deviceId = NULL,$userId = NULL)
    {
        $b = new ErrorMessage();
        if(empty($deviceId) || !isset($deviceId))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        
        return $this->botLog->botLog($deviceId,$userId);
    }

    public function getAtoStatsinfo($DateFilter = array())
    {
        $b = new ErrorMessage();

        if(empty($DateFilter) || !isset($DateFilter))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(count($DateFilter) == 0)
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        return $this->StatsObj->getAtoStats($DateFilter);
    }

    public function getTransStatsinfo($DateFilter = array())
    {
        $b = new ErrorMessage();

        if(empty($DateFilter) || !isset($DateFilter))
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        if(count($DateFilter) == 0)
        {
            $msg['status'] = "error";
            $erno = 1;
            $msg['message'] = $b->errormsg($erno);
            return $msg;
        }
        return $this->StatsObj->getTransStats($DateFilter);
    }

    
}