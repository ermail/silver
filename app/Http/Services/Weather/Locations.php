<?php

namespace App\Http\Services\Weather;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

class Locations
{
    static function getLocations():array{
        $yamlContents = Yaml::parse(
            Storage::disk('local')->get('public/parameters.yaml')
        );
        return $yamlContents['locations'];
    }

    static function getWeatherForLocation($location):float{
        $url = config('weather.api_url') . $location .
            '&appid='. config('weather.api_key') .
            '&lang=' .  config('weather.api_language.deutsch') .
            '&units=' .  config('weather.api_units.metric');
      //  dd($url);
        $result = (new Client())->get($url)->getBody()->getContents();
        $weather = json_decode($result, true);
      //  dd($weather['main']['temp']);
        return round($weather['main']['temp'], 1);
    }
}
