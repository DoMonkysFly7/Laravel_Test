<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use SimpleXMLElement;

class XMLTestController extends Controller
{
    public function index(Request $request) {

        $xmlPath = public_path('countries.xml'); 
        $xmlContent = file_get_contents($xmlPath);
        $xmlObject = simplexml_load_string($xmlContent);

        // First, the easies
        $countries_eurozone = $xmlObject->xpath("//country[currency='Euro']");
        
        // Convert the XML object into an array of countries
        $countries = [];
        foreach ($xmlObject->country as $country) {
            $mapUrl = (string)$country->map_url;
            $pattern = '/@([-+]?[0-9]*\.?[0-9]+),([-+]?[0-9]*\.?[0-9]+)/';
            $latitude = $longitude = '';
            if (preg_match($pattern, $mapUrl, $matches)) {
                $latitude = $matches[1];
                $longitude = $matches[2];
            }

            $countries[] = [
                'region' => (string)$country['zone'],
                'name' => (string)$country->name,
                'language' => (string)$country->language,
                'currency' => (string)$country->currency,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];
        }

        // Sort countries by region and name in English
        usort($countries, function ($a, $b) {
            return [$a['region'], $a['name']] <=> [$b['region'], $b['name']];
        }); 


        // Apply filter if necessary
        $selectedRegion = $request->get('region');
        if ($selectedRegion && $selectedRegion !== 'choose') {
            $countries = array_filter($countries, function ($country) use ($selectedRegion) {
                return $country['region'] === $selectedRegion;
            });
        }


        // Here I figured I could technically create the table directly in this script , given that the proposed role is 'Backend Developer',
        // but that would be harder to handle, so I used my FUll-Stack knowledge and created the view with the necessary contents.

        // I can do it both ways though.
        return view('index')->with([
            'countries' => $countries,
            'countries_eurozone' => $countries_eurozone,
            'selectedRegion' => $selectedRegion
        ]);
    }

  
}
