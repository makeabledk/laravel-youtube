<?php

namespace Makeable\Youtube\Tests;

use Makeable\Youtube\YoutubeUser;

class YoutubeClientTest extends TestCase
{

    public function testGetSubscribers()
    {
        $token = [
          "access_token" => "ya29.GlvcBM8fq9Gm0ykIdj4CSY7Ki7PZ8BF4SPiBjSE8wCwfdUYFkS4-LoLEXZ9G5UTKQnvGh1zlsV0eMDILZFXF4Kfgc-2aWOllIxxQLgwZfTKSDt_uJFA_stEFznxu",
          "token_type" => "Bearer",
          "expires_in" => 3588,
          "created" => 1507210143
        ];

        $user = YoutubeUser::find($token);
        $channels = $user->getChannels();

        $this->assertEquals(
          9,
          $channels
            ->first()
            ->getSubscribers());
    }
}
