<?php

namespace App\Livewire\Front\Panel\Components;

use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class GetLocation extends Component
{
    use LivewireAlert;

    public $latid = 0;
    public $lngid = 0;
    public $str_address;
    public $pre_address;
    protected $listeners = [
        'confirmed'
    ];

    public function showLocation()
    {
        try
        {
            $building_id =  session()->get('building_id');
            $building = \App\Models\Building::find( $building_id);
            $lat = $this->latid;
            $lng = $this->lngid;

            $apiKey = config('neshan.Api-service_key');


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
                    $this->pre_address = $address;

                    $this->str_address = $address .'،'." ساختمان ".$building?->builder_name ?? '';
                    $this->alert('info', $this->str_address, [

                        'toast' => true,
                        'showConfirmButton' => true,
                        'onConfirmed' => 'confirmed',
                        'confirmButtonText' => 'تایید',
                        'timer' => null,
                    ]);

                }
                else
                {
                    $this->alert('warning', 'استعلام آدرس ممکن نیست،آدرس را بصورت دستی وارد نمایید');
                }
            }
            else
            {
                $this->alert('warning', 'Error: ' . $response->body() );
            }
        }
        catch (Throwable $e)
        {
            $this->alert('error', $e->getMessage());
            setLog('Get-Address',$e->getMessage(),'warning');
        }
    }

    public function saveLocation()
    {
        $building_id =  session()->get('building_id');
        $building = \App\Models\Building::find( $building_id);
        $building->address = $this->pre_address;
        $building->latitude = $this->latid;
        $building->longitude = $this->lngid;
        $building->save();
        $this->flash('success','اطلاعات آدرس ذخیره شد',[],route('panel',['page'=>'building']));

    }


    public function render()
    {
        return view('livewire.front.panel.components.get-location');
    }
}
