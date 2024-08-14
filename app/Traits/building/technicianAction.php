<?php

namespace App\Traits\building;

trait technicianAction
{
    public $broken_elevator_id;
    public $failure_cause;
    public $failure_description;




    public function sendFaultRequest()
    {
        try
        {
            $this->validate([
                'broken_elevator_id' => 'required|integer|exists:elevators,id',
                'failure_cause' => 'required|string|max:255',
                'failure_description' => 'nullable|string|max:1000',
            ]);

            $this->alert('success','');

        }
        catch (\Throwable $e)
        {
            $this->alert('warning',$e->getMessage());
        }

    }

}


