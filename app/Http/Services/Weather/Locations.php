<?php

namespace App\Http\Services\Weather;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

/**
 *Parse Location and Weather data
 */
class Locations
{
    /**
     * Content from .yaml file.
     * @return array
     * @throws FileNotFoundException
     */
    static function getLocations(): array
    {
        $yamlContents = Yaml::parse(
            Storage::disk('local')->get('public/parameters.yaml')
        );

        return $yamlContents['locations'];
    }

    /**
     * @param $location
     * Data from API
     * @return float
     * @throws GuzzleException
     */
    static function getWeatherForLocation($location): float
    {
        $url = config('weather.api_url').$location.
            '&appid='.config('weather.api_key').
            '&lang='.config('weather.api_language.deutsch').
            '&units='.config('weather.api_units.metric');
        $result = (new Client())->get($url)->getBody()->getContents();
        $weather = json_decode($result, true);

        return round($weather['main']['temp'], 1);
    }
}
