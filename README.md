# Laravel Youtube
Fetches YouTube channel data based on oAuth

## Installation

```
composer require makeabledk/laravel-youtube
```

Add the following config to your `config/services.php` 

```php
return [

    // ...

    'google' => [
        'oauth_client_id' => env('GOOGLE_OAUTH_CLIENT_ID'), // provide your client id
        'oauth_client_secret' => env('GOOGLE_OAUTH_CLIENT_SECRET'), // provide your client secreT
    ],
```

## Example usage

```php
    $user = YoutubeUser::find($token); // Provide refresh token
    $channels = $user->getChannels();

    echo $channels->first()->getSubscribers();
```
