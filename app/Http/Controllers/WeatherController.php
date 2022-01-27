<?php

namespace App\Http\Controllers;

use App\Http\Services\Weather\Locations;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

class WeatherController extends Controller
{
    public function index(){

       $locations = Locations::getLocations();

        return view('welcome', compact('locations'));
    }
}
