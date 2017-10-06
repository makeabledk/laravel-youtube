<?php

namespace Makeable\Youtube;

use Google_Service_YouTube;

class YoutubeChannel
{

    protected $id;
    protected $data;

    public function __construct($channelData)
    {
        $this->id = $channelData['id'];
        $this->data = $channelData;
    }

    public static function all(YoutubeUser $user)
    {
        $response = (new Google_Service_YouTube($user->getClient()))
            ->channels->listChannels(
              'snippet,statistics',
              ['mine' => true]
          );

        return collect($response['items'])
            ->map(function ($channel) {
                return new YoutubeChannel($channel);
            });
    }


    /**
     * @return int number of subscribers to channel.
     */
    public function getSubscribers()
    {
        return $this->data['statistics']['subscriberCount'];
    }

    /**
     * @return mixed the raw response partial for the channel
     */
    public function getRaw()
    {
        return $this->data;
    }
}
