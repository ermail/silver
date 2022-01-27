<?php

namespace App\Http\Controllers;

use App\Http\Services\Weather\Locations;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


/**
 *View Weather for Locations
 */
class WeatherController extends Controller
{

    /**
     * @return Application|Factory|View
     * @throws FileNotFoundException
     */
    public function index()
    {
        $locations = Locations::getLocations();

        return view('welcome', compact('locations'));
    }
}
