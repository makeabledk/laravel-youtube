# youtube-channel-data
Fetches YouTube channel data based on oAuth


Example on use

```php
    $youtubeUser = YoutubeUser::find(
          // Provide refresh token
    );
    $channels = $youtubeUser->getChannels();

    $channels
        ->first()
        ->getSubscribers()
```
