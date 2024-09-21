<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\Elevator;
use App\Models\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Throwable;


class FaultAlert extends Component
{

    use LivewireAlert, WithoutUrlPagination;

    public $elevator_id;
    public $list;
    public $building_list = [];
    public $building_id;
    public $description;
    public $technician_list;
    public $fault_cause;

    public $elevator_list;

    public $building;
    public $referral;
    public $request_created;
    public $request_list = [];
    public $timeout;


    public function sendRequest()
    {


        try {
            $this->validate([
                'elevator_id' => 'required|numeric|exists:elevators,id',
                'fault_cause' => 'nullable|string|max:200',
                'description' => 'nullable|string|max:255',
            ]);


            $building = \App\Models\Building::with(['elevators', 'companies'])->findOrFail($this->building_id);

            $elevator = Elevator::findOrFail($this->elevator_id);

            if ($building->companies->isEmpty()) {

                $this->alert('warning', 'هنوز هیچ تکنسینی برای ساختمان شما اختصاص داده نشده است');

            } else {
                $executed = RateLimiter::attempt(
                    'send-request-technician' . session()->getId(),
                    2,
                    function () use ($building, $elevator) {
                        $random_int = random_int(1000000, 9999999);

                        //$requiredSkillIds = [12];

                        foreach ($building->companies->first()->technicians as $technician) {

                            // بررسی اینکه تکنسین آیا مهارت با شناسه 12 را دارد یا خیر
                            $technicianSkill = $technician->skills()
                                ->where('skills.id', 12)
                                ->wherePivot('approved',1)
                                ->first();

                            if ($technicianSkill) {


                                $request = new Request();
                                $request->user_id = Auth::id();
                                $request->referral = $random_int;
                                $request->technician_id = $technician->id;
                                $request->building_id = $building->id;
                                $request->status = 'pending';

                                $elevatorAlert = 'آسانسور : ' . $elevator->getType() . ' ' . $elevator->model;
                                $cause = ' به علت : ' . $this->fault_cause . '.';
                                $causeDescription = "\nتوضیحات: " . $this->description;
                                $full_description = $elevatorAlert . ' ' . $cause . ' ' . $causeDescription;
                                $request->description = $full_description;
                                $request->save();

                                // ارسال پیامک به تکنسین
                                $technician_name = $technician->profile->name;
                                $parameter1 = new \Cryptommer\Smsir\Objects\Parameters('name', $technician_name);
                                $parameters = array($parameter1);
                                 //sendVerifySms($technician->phone, config('sms.technician_alert_template_id'), $parameters);

                            }
                        }


                        if (isset($request)) {
                            $technician_count = $building->companies()->first()->technicians->count();
                            $this->alert('info', 'درخواست شما ارسال شد');

                            $this->referral = $request->referral;

                            $this->request_created = jdate($request->created_at)->toTimeString();
                            $this->request_list = Request::whereUserId(auth()->id())->orderByDesc('created_at')->take(15)->get();
                        }


                    }


                );

                if (!$executed) {
                    $this->alert('error', 'لطفا چند لحظه دیگر مجددا سعی کنید.');
                }


            }


        } catch (Throwable $e) {
            $this->alert('warning', $e->getMessage());
        }


    }


    public function updatedBuildingId($value)
    {
        try {
            $this->validate(['building_id' => 'required|exists:buildings,id']);
            $building = \App\Models\Building::with('members', 'elevators')->find($this->building_id);
            $this->elevator_list = $building->elevators;
        } catch (Throwable $e) {
            $this->alert('warning', $e->getMessage());
        }


    }


    public function requestsTimeout(): void
    {
        if (auth()->user()->activeRequests()->count() > 0) {

            $requests = Request::whereUserId(auth()->id())
                ->where('created_at', '<=', Carbon::now()->subMinutes(14))
                ->where('status', 'pending')
                ->get();

            foreach ($requests as $request) {
                $request->status = 'cancelled';
                $request->save();


            }
        }
    }


    public function mount()
    {


        if (!$this->authorize('manager')) {
            abort(403, 'دسترسی شما در سیستم به عنوان مدیر ساختمان ثبت نشده است.');
        }
        $this->building_list = \App\Models\Building::whereUserId(auth()->id())->get();
        $this->request_list = Request::whereUserId(auth()->id())->orderByDesc('created_at')->take(15)->get();


    }

    public function render()
    {
        return view('livewire.front.panel.components.fault-alert');
    }
}
