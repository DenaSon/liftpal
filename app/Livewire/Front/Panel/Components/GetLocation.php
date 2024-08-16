<?php

namespace App\Livewire\Front\Panel\Components;

use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class GetLocation extends Component
{
    use LivewireAlert;

    public $latid = 0;
    public $lngid = 0;
    public $str_address;


    public function showLocation()
    {
        $building_id =  session()->get('building_id');
        $building = \App\Models\Building::findOrFail( $building_id);
        $lat = $this->latid;
        $lng = $this->lngid;

        $apiKey = "service.f0b032318487462a8dfa467aff93408a";

        // Make a GET request to the reverse geocoding API
        $response = Http::withHeaders([
            'Api-Key' => $apiKey,
        ])->get('https://api.neshan.org/v5/reverse', [
            'lat' => $lat,
            'lng' => $lng,
        ]);

        // Check if the response was successful
        if ($response->successful()) {
            $result = $response->json();

            if (isset($result['formatted_address'])) {
                $address = $result['formatted_address'];

                    $this->str_address = $address .'،'." ساختمان ".$building?->builder_name;

            }
            else
            {
                $this->alert('warning', 'استعلام آدرس ممکن نیست،آدرس را بصورت دستی وارد نمایید');
            }
        }
        else
        {
            $this->alert('warning', 'Error: ' . $response->body() . ' ' . app()->currentLocale());
        }
    }


    public function render()
    {
        return view('livewire.front.panel.components.get-location');
    }
}
