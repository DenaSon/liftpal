<?php

namespace App\Livewire\Front\Panel\Components;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

#[Lazy]
class Building extends Component
{
    use LivewireAlert, WithPagination;

    // building fields;
    public $building_list = [];
    public $building_address;
    public $manager_name;
    public $manager_contact;
    public $building_name;
    public $building_floors;
    public $building_units;
    public $emergency_contact;

    //elevator_fields

    public $building_id;
    public $model;
    public $capacity;
    public $type;
    public $manufacturer;
    public $last_inspection_date;
    public $installation_date;
    public $status;
    public $last_maintenance_date;
    public $next_maintenance_date;
    public \App\Models\Building $building;

    //members_fields
    public $member_list = [];
    public $full_name;
    public $unit;
    public $phone;
    public $role;
    public $is_active;



    private function sendSms($phone)
    {
        sendVerifySms('1111',$phone,100000,'CODE');
    }

    public function sendBuildingAlert($buildId)
    {
      $building = \App\Models\Building::with('members')->findOrFail($buildId);
      foreach ($building->members as $member)
      {
         $this->sendSms($member->phone);
         sleep(1);
      }

    }

    public function resetForm()
    {

        $this->building_id = null;
        $this->building_name = null;
        $this->building_address = null;
        $this->manager_name = null;
        $this->manager_contact = null;
        $this->building_floors = null;
        $this->building_units = null;
        $this->emergency_contact = null;
    }

    public function addBuilding()
    {

        try {
            $this->validate([
                'building_address' => 'required|string',
                'manager_name' => 'required|string',
                'manager_contact' => 'required|digits:11',
                'building_name' => 'required|string|nullable',
                'building_floors' => 'required|numeric|max:50',
                'building_units' => 'required|numeric|max:50',
                'emergency_contact' => 'required|digits:11',

            ]);

            $building = new \App\Models\Building();
            $building->address = $this->building_address;
            $building->manager_name = $this->manager_name;
            $building->manager_contact = $this->manager_contact;
            $building->builder_name = $this->building_name;
            $building->floors = $this->building_floors;
            $building->units = $this->building_units;
            $building->emergency_contact = $this->emergency_contact;
            $building->user_id = auth()->user()->id;
            $building->save();
            $this->flash('success', 'ساختمان جدید افزوده شد',[],route('panel',['page'=>'building']));
            $this->reset();
            $this->dispatch('building_added');


        } catch (Throwable $e) {
            $this->alert('info', $e->getMessage());

        }

    }

    public function editBuilding($id)
    {
        $building = \App\Models\Building::find($id);
        $this->building_id = $building->id;
        $this->building_name = $building->builder_name;
        $this->building_address = $building->address;
        $this->manager_name = $building->manager_name;
        $this->manager_contact = $building->manager_contact;
        $this->building_floors = $building->floors;
        $this->building_units = $building->units;
        $this->emergency_contact = $building->emergency_contact;

    }

    public function updateBuilding()
    {

        $this->validate([
            'building_name' => 'required|string|max:255',
            'building_address' => 'required|string|max:255',
            'manager_name' => 'required|string|max:255',
            'manager_contact' => 'required|string|max:255',
            'building_floors' => 'required|integer|min:1',
            'building_units' => 'required|integer|min:1',
            'emergency_contact' => 'required|string|max:255',
        ]);


        $building = \App\Models\Building::find($this->building_id);


        $building->builder_name = $this->building_name;
        $building->address = $this->building_address;
        $building->manager_name = $this->manager_name;
        $building->manager_contact = $this->manager_contact;
        $building->floors = $this->building_floors;
        $building->units = $this->building_units;
        $building->emergency_contact = $this->emergency_contact;


        $building->save();


        $this->flash('success', 'اطلاعات ساختمان با موفقیت ویرایش شد',[],route('panel',['page'=>'building']));
        $this->dispatch('buildingUpdated');

    }


    public function addElevator(): void
    {
        try {


            $this->validate([
                'building_id' => 'required|integer',
                'model' => 'required|string|max:255',
                'capacity' => 'required|integer',
                'type' => 'required|string|max:255',
                'manufacturer' => 'nullable|string|max:255',
                'status' => 'required|string|max:255',


            ]);

            \App\Models\Elevator::create([
                'user_id' => auth()->user()->id,
                'building_id' => $this->building_id,
                'model' => $this->model,
                'capacity' => $this->capacity,
                'type' => $this->type,
                'manufacturer' => $this->manufacturer,
                'status' => $this->status,

            ]);

            $this->alert('success', 'آسانسور جدید افزوده شد');
            $this->reset();
            $this->dispatch('elevator_added');
        } catch (Throwable $e) {
            $this->alert('info', $e->getMessage());

        }
    }


    public function addMember(): void
    {

        try {


            $validatedData = $this->validate([
                'full_name' => 'required|string|max:255',
                'unit' => 'required|string|max:255',
                'phone' => 'required|string|digits:11|unique:members,phone',
                'role' => 'required|in:owner,tenant,manager,other',
                'is_active' => 'nullable|boolean',
               'building_id' => 'required|exists:buildings,id',
            ]);


            $validatedData['user_id'] = auth()->id();
            $validatedData['is_active'] = $this->is_active ?? 1;
            $member = new \App\Models\Member();
            $member->fill($validatedData);
            $member->user_id = auth()->id();
            $member->save();
            $this->alert('success', 'عضو جدید اضافه شد');
            $this->reset();
            $this->dispatch('member_added');

        } catch (Throwable $e) {

            $this->alert('info', $e->getMessage());
        }
    }

    public function removeBuilding($id): void
    {
        $building = \App\Models\Building::find($id);

        if ($building) {
            $building->elevators()->delete();
            $building->members()->delete();
            $building->delete();
            $this->flash('info', 'ساختمان حذف شد',[],route('panel',['page'=>'building']));
        } else {
            $this->alert('warning', 'ساختمان یافت نشد');
        }
    }

    public function removeElevator($id): void
    {
        $building = \App\Models\Elevator::find($id);

        if ($building) {
            $building->delete();
            $this->alert('info', 'آسانسور حذف شد');
        } else {
            $this->alert('warning', 'آسانسور یافت نشد');
        }
    }

    public function removeMember($id): void
    {
        $member = \App\Models\Member::find($id);

        if ($member) {
            $member->delete();
            $this->alert('info', 'عضو حذف شد');
        }
        else {
            $this->alert('warning', 'عضو یافت نشد');
        }
    }




    public function render()
    {


        $this->building_list = \App\Models\Building::whereUserId(auth()->user()->id)->latest('id')->take(10)->get();
        $this->elevator_list = \App\Models\Elevator::whereUserId(auth()->user()->id)->latest('id')->take(10)->get();
        $this->member_list = \App\Models\Member::whereUserId(auth()->user()->id)->latest('id')->take(25)->get();

        if ($this->building_list->count() == 1)
        {
           $this->building_id = $this->building_list[0]->id;
        }


        return view('livewire.front.panel.components.building',
            [
                'building_list' => $this->building_list,
                'elevator_list' => $this->elevator_list,
                'member_list' => $this->member_list
            ]);
    }

}
