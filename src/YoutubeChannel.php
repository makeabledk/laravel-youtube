<?php

namespace Makeable\LaravelYoutube;

use Google_Service_YouTube;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use JsonSerializable;

class YoutubeChannel implements Arrayable, JsonSerializable
{
    use HasAttributes;

    /**
     * YoutubeChannel constructor.
     * @param $data
     */
    public function __construct(\Google_Service_YouTube_Channel $data)
    {
        $this->fill((array) $data->toSimpleObject());
    }

    /**
     * @param YoutubeUser $user
     * @return Collection
     */
    public static function all(YoutubeUser $user)
    {
        $response = (new Google_Service_YouTube($user->getClient()))
            ->channels->listChannels('snippet,statistics', ['mine' => true]);

        return collect($response['items'])->map(function ($channel) {
            return new YoutubeChannel($channel);
        });
    }

    /**
     * @param YoutubeUser $user
     * @param $id
     * @return YoutubeChannel|null
     */
    public static function find(YoutubeUser $user, $id)
    {
        return static::all($user)->first(function ($channel) use ($id) {
            return $channel->id === $id;
        });
    }

    /**
     * @return int
     */
    public function getSubscribers()
    {
        return data_get($this->attributes, 'statistics.subscriberCount');
    }
}
