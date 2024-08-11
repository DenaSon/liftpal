<?php

namespace App\Livewire\Front\Panel\Components;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Throwable;

#[Lazy]
class Building extends Component
{
    use LivewireAlert;
   public $building_address;
   public $manager_name;
   public $manager_contact;
   public $building_name;
   public $building_floors;
   public $building_units;
   public $emergency_contact;

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


       }
       catch (Throwable $e)
       {
           $this->alert('info', $e->getMessage());
       }

   }


    public function render()
    {

        return view('livewire.front.panel.components.building');
    }
}
