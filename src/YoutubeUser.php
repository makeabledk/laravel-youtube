<?php
/**
 * Created by PhpStorm.
 * User: troels
 * Date: 05/10/2017
 * Time: 11.44
 */

namespace Makeable\Youtube;


class YoutubeUser
{

    public static function find($token)
    {
        return app(YoutubeClient::class)->client->setAccessToken(
          $token
        );
    }

    public function getChannels()
    {

    }

}
