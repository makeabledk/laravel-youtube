<?php
/**
 * Created by PhpStorm.
 * User: troels
 * Date: 05/10/2017
 * Time: 08.11
 */

namespace Makeable\Youtube;

use Google_Client;
use Google_Service_YouTube;

class YoutubeClient
{
    public $client;

    public function __construct($credentialFile, $appName=null)
    {
        if (!$appName) {
            $appName = config('app.name');
        }
        $this->client = new Google_Client();
        $this->client->setApplicationName($appName);
        $this->client->setAuthConfig($credentialFile);
    }
}
