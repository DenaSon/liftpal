<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\User;
use App\Traits\globalFunctionality;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Throwable;

class Address extends Component
{

    // Get address fields
    public $province;
    public $country;
    public $city;
    public $postal_address;
    public $postal_code;
    public $building_number;
    public $unit_number;

    use globalFunctionality, LivewireAlert;
    public $user;
    public \App\Models\Address $address;


    public function saveAddress()
    {

        try {
            $authId = auth()->id();
            // Validate the fields
            $validatedData = $this->validate([
                'province' => 'required|string|max:255',
                'country' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'postal_address' => 'required|string|max:255',
                'postal_code' => 'required|string|digits:10',
                'building_number' => 'nullable|string|max:10',
                'unit_number' => 'nullable|string|max:10',
            ]);
            // Setting default values


            \App\Models\Address::whereUserId($this->authUserId)->update(['is_default' => 0]);
            $validatedData['is_default'] = 1;
            $validatedData['country'] = 'ایران';
            $validatedData['user_id'] = $authId;
            // Save the validated data to the Addresses table
            if (\App\Models\Address::create($validatedData)) {
                $this->reset(['province', 'country', 'city', 'postal_address', 'postal_code', 'building_number', 'unit_number']);
                $this->alert('success', 'آدرس شما با موفقیت ثبت شد', ['position' => 'center']);


            }

        } catch (Throwable $e) {
            $this->alert('error', $e->getMessage(), ['position' => 'center']);
        }


    }

    public function mount()
    {
        $this->user = auth()->user();

    }

    public function deleteAddress($addressId)
    {
        $address = \App\Models\Address::findOrFail($addressId);
        $this->authorize('delete',$address);
        $address->delete();
    }

    public function setDefaultAddress($addressId): void
    {

        $this->address = \App\Models\Address::whereId($addressId)->whereUserId($this->authUserId)->firstOrFail();
        \App\Models\Address::whereUserId($this->authUserId)->where('id','!=',$addressId)->update(['is_default' => 0]);
        $this->address->is_default = 1;
        $this->address->save();
        $this->alert('success','آدرس پیش فرض تغییر کرد');

    }
}
