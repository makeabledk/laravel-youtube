<?php

namespace Makeable\Youtube\Tests;

use Makeable\Youtube\YoutubeClient;
use Makeable\Youtube\YoutubeUser;
use Google_Service_YouTube;

class YoutubeClientTest extends TestCase
{
    public function GetUserFromToken()
    {
        $credentials = 'application-credentials.json';
        // As singleton
        $client = new YoutubeClient($credentials, 'Yo Hype test'); // (keyFile, appName = null config(app.name)

        $token = [
          "access_token"=> "ya29.GlvbBKsvhnArbRmw4kBydbkYFnGRK3QTZAfPHXAkTzNH_pEEIA8whFEVEhaoXBMJ6R-74PL9wFRvCHG4JBIZgDTF57sJs_DXtHFFTVE7bluoU0xgTN-M66eEVRAJ",
          "token_type"=> "Bearer",
          //"expires_in"=> 3588,
          //"created"=> 1507210143
        ];

        $client->client->setAccessToken(
          $token
        );

        $service = new Google_Service_YouTube($client->client);

        $response = $service->channels->listChannels(
          'snippet,statistics',
          array(
            'mine' => true,
          )
        );


        foreach ($response['items'] as $channel) {
            $channelClean['id'] = $channel['id'];
            $channelClean['title'] = $channel['snippet']['title'];
            $channelClean['viewcount'] = $channel['statistics']['viewCount'];
            $channelClean['subcount'] = $channel['statistics']['subscriberCount'];
            $channelClean['videocount'] = $channel['statistics']['videoCount'];
            $channels[] = $channelClean;
        }

        var_dump($channels);
    }

    public function testFoo()
    {
        $token = [
          "access_token"=> "ya29.GlvbBKsvhnArbRmw4kBydbkYFnGRK3QTZAfPHXAkTzNH_pEEIA8whFEVEhaoXBMJ6R-74PL9wFRvCHG4JBIZgDTF57sJs_DXtHFFTVE7bluoU0xgTN-M66eEVRAJ",
          "token_type"=> "Bearer",
          "expires_in"=> 3588,
          "created"=> 1507210143
        ];

        $user = YoutubeUser::find($token); // app(YoutubeTClient::class)

        dd($user);



//        $channels = $user->getChannels(); // collection ?
//        $channels->count(); //
//        $channels // Illuminate Collection
//          ->first() // YoutubeChannel
//          ->getSubscribers(); // int
    }
}
