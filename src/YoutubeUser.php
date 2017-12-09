<?php

namespace Makeable\LaravelYoutube;

use Cache;
use Illuminate\Support\Collection;

class YoutubeUser
{
    /**
     * @var
     */
    protected $client;

    /**
     * YoutubeUser constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param $refreshToken
     * @return \Google_Client|static
     */
    public static function find($refreshToken)
    {
        $cacheKey = 'youtube_access_token_'.md5($refreshToken);

        $user = new static;
        $user->client = app(YoutubeClient::class);

        if (($cached = Cache::get($cacheKey)) !== null) {
            $user->client->setAccessToken($cached);
        }

        if ($user->client->isAccessTokenExpired()) {
            $token = $user->client->refreshToken($refreshToken);
            $user->client->setAccessToken($token);

            // Google oAuth tokens are available for 3600 seconds.
            Cache::put($cacheKey, $token, 55);
        }

        return $user;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return Collection
     */
    public function getChannels()
    {
        return YoutubeChannel::all($this);
    }
}
