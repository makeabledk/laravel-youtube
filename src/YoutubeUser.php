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

    public static function find($refreshToken)
    {
        $cachekey = 'youtube_access_token_'.md5($refreshToken);

        /* @var \Google_Client $user->client */
        $user = new static;
        $user->client = app(YoutubeClient::class);

        if (($cached = \Cache::get($cachekey)) !== null) {
            $user->client->setAccessToken($cached);
        }

        if ($user->client->isAccessTokenExpired()) {
            $token = $user->client->refreshToken($refreshToken);
            $user->client->setAccessToken($token);
            // Google oAuth tokens are available for 3600 seconds.
            \Cache::put($cachekey, $token, 55);
        }

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
