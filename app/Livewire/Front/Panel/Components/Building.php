<?php

namespace App\Livewire\Front\Panel\Components;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

#[Lazy]
class Building extends Component
{
    use LivewireAlert,WithPagination;

    // building fields;
    public $building_list =[];
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


    public function addBuilding()
   {

       try
       {
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
           $this->alert('success', 'ساختمان جدید افزوده شد');
           $this->reset();
           $this->dispatch('building_added');


       }
       catch (Throwable $e)
       {
           $this->alert('info', $e->getMessage());

       }

   }

   public function addElevator(): void
   {
       try {


           $this->validate([
               'building_id' => 'required|integer',
               'model' => 'required|string|max:255',
               'capacity' => 'required|integer',
               'type' => 'required|string|max:255',
               'manufacturer' => 'required|string|max:255',
               'last_inspection_date' => 'required',
               'installation_date' => 'required',
               'status' => 'required|string|max:255',
               'last_maintenance_date' => 'nullable',
               'next_maintenance_date' => 'nullable',
           ]);

           \App\Models\Elevator::create([
               'user_id' => auth()->user()->id,
               'building_id' => $this->building_id,
               'model' => $this->model,
               'capacity' => $this->capacity,
               'type' => $this->type,
               'manufacturer' => $this->manufacturer,
               'last_inspection_date' => $this->last_inspection_date,
               'installation_date' => $this->installation_date,
               'status' => $this->status,
               'last_maintenance_date' => $this->last_maintenance_date,
               'next_maintenance_date' => $this->next_maintenance_date,
           ]);

           $this->alert('success', 'آسانسور جدید افزوده شد');
           $this->reset();
           $this->dispatch('elevator_added');
       }
       catch (Throwable $e)
       {
           $this->alert('info', $e->getMessage());

       }
   }

    public function removeBuilding($id): void
    {
        $building = \App\Models\Building::find($id);

        if ($building) {
            $building->elevators()->delete();
            $building->delete();
            $this->alert('info', 'ساختمان حذف شد');
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


    public function render()
    {

       $this->building_list = \App\Models\Building::whereUserId(auth()->user()->id)->latest('id')->take(10)->get();
       $this->elevator_list = \App\Models\Elevator::whereUserId(auth()->user()->id)->latest('id')->take(10)->get();

        return view('livewire.front.panel.components.building',
                ['building_list' => $this->building_list,
                'elevator_list' => $this->elevator_list]);
    }
}
