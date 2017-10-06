<?php
/**
 * Created by PhpStorm.
 * User: troels
 * Date: 05/10/2017
 * Time: 11.44
 */

namespace Makeable\Youtube;


use Google_Service_YouTube;
use Illuminate\Support\Collection;
use Makeable\Youtube\YoutubeChannel;

class YoutubeUser
{

    protected $client;

    private function __construct()
    {
    }


    public static function find($token)
    {
        $user = new static;
        $user->client = app(YoutubeClient::class);
        $user->client->setAccessToken($token);

        return $user;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getChannels()
    {
        return YoutubeChannel::all($this);
    }

}
