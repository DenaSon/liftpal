<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\Elevator;
use App\Models\Request;
use App\Services\NeshanService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Throwable;


class FaultAlert extends Component
{

    use LivewireAlert,WithoutUrlPagination;

    public $elevator_id;
    public $list;
    public $building_list =[];
    public $building_id;
    public $description;
    public $technician_list;
    public $fault_cause;

    public $elevator_list;

    public $building;
    public $referral;
    public $request_created;
    public $request_list =[];



    public function sendRequest()
    {
        try {
            $this->validate([
            'elevator_id' => 'required|numeric|max:200|exists:elevators,id',
                'fault_cause' => 'nullable|string|max:200',
                'description' => 'nullable|string|max:255',
            ]);

            $building = \App\Models\Building::with(['elevators', 'technicians','companies'])->findOrFail($this->building_id);
            $elevator = Elevator::findOrFail($this->elevator_id);

            if($building->technicians->count() == 0)
            {
                $this->alert('warning','هنوز هیچ تکنسینی برای ساختمان شما اختصاص داده نشده است');

            }
            else
            {
                $executed = RateLimiter::attempt(
                    'send-request-technician'.session()->getId(),
                    2,
                    function() use ($building, $elevator)
                    {
                        $random_int  =  random_int(1000000,9999999);
                        foreach($building->technicians as $technician)
                        {
                            //send request
                            $request = new Request();
                            $request->user_id = Auth::id();
                            $request->referral = $random_int;
                            $request->technician_id = $technician->id;
                            $request->building_id = $building->id;
                            $request->status = 'pending';

                            $elevatorAlert = 'گزارش خرابی آسانسور' . $elevator->getType() . ' ' . $elevator->model;
                            $cause = ' به علت : ' . $this->fault_cause .'.';
                            $buildingId = ' ساختمان :' . $building->builder_name . ' . ';
                            $address = 'به آدرس : ' . $building->address . ' .';
                            $causeDescription = "\nتوضیحات: " . $this->description;
                            $full_description = $elevatorAlert . $cause . $buildingId . $address . $causeDescription;
                            $request->description = $full_description;
                            $request->save();

                        }

                        $this->referral = $request->referral;

                       // $now = Carbon::now();
                       // $difference  = $now->diffInSeconds($request->created_at);
                        $this->request_created = jdate($request->created_at)->toTimeString();

                        $this->request_list = Request::whereUserId(auth()->id())->orderByDesc('created_at')->take(15)->get();
                    }
                );

                if (! $executed) {
                    $this->alert('error','لطفا چند لحظه دیگر مجددا سعی کنید.');
                }




            }



        }
        catch (Throwable $e) {
            $this->alert('warning', $e->getMessage());
        }


    }


    public function updatedBuildingId($value)
    {
        try {
            $this->validate(['building_id' => 'required|exists:buildings,id']);
            $building = \App\Models\Building::with('members', 'elevators')->find($this->building_id);
            $this->elevator_list = $building->elevators;
        }
        catch (Throwable $e) {
            $this->alert('warning', $e->getMessage());
        }


    }

    public function mount()
    {

        $this->building_list = \App\Models\Building::whereUserId(auth()->id())->get();
        $this->request_list = Request::whereUserId(auth()->id())->orderByDesc('created_at')->take(15)->get();


    }

    public function render()
    {
        return view('livewire.front.panel.components.fault-alert');
    }
}
