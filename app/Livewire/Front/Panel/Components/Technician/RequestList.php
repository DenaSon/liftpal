<?php

namespace App\Livewire\Front\Panel\Components\Technician;

use App\Models\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class RequestList extends Component
{
    use LivewireAlert;

    public $request_list = [];
    public $id;

    public $referral;
    public $request_history = [];

    public function mount()
    {
        if (!$this->authorize('technician'))
        {
            abort(403,'دسترسی شما در سیستم به عنوان کارشناس فنی ثبت نشده است.');
        }
        $this->request_list = Request::with(['building'])
       ->whereTechnicianId(\Auth::id())
            ->where('status', 'pending')
            ->get();

        $this->request_history = auth()->user()->requests()->latest()->take(20)->get();


    }



    public function refreshList()
    {
        $this->request_list = Request::whereTechnicianId(\Auth::id())
            ->where('status', 'pending')
            ->get();
    }

    public function cancelRequest($id): void
    {
        $this->id = $id;
        try {
            $this->validate(['id' => 'required|numeric|exists:requests,id']);
            Request::whereId($id)->whereStatus('pending')->update(['status' => 'rejected']);
            $this->alert('info', 'درخواست لغو شد');
        }
        catch (Throwable $e) {
            $this->alert('error', $e->getMessage());
        }

    }

    public function acceptRequest($id,$referral): void
    {
        $this->id = $id;
        $this->referral = $referral;
        try {
            $this->validate(['id' => 'required|numeric|exists:requests,id' ,'referral' => 'required|numeric|exists:requests,referral']);
          Request::whereReferral($referral)
              ->whereId($id)
              ->whereStatus('pending')
              ->update(['status' => 'accepted']);

            Request::whereReferral($referral)
                ->whereStatus('pending')
                ->update(['status' => 'cancelled']);

            $this->alert('info', 'درخواست تایید شد');
            $request = Request::findOrFail($id);
            $building_owner_number = $request->building->owner->phone;
            $template_id = config('sms.technician_name_alert');
            $technician_name = auth()->user()->profile?->name. ' ' .auth()->user()->profile?->last_name;

            $this->sendSmsToManager($technician_name,$building_owner_number,$template_id);



        }
        catch (Throwable $e) {
            $this->alert('error', $e->getMessage());
            setLog('Technician_Accept_Request',$e->getMessage(),'danger');
        }
    }


    private function sendSmsToManager($technician_name,$building_owner_number,$template_id): void
    {
        $parameter = new \Cryptommer\Smsir\Objects\Parameters('TECHNICIAN_NAME',$technician_name);
        $parameters = array($parameter);
        sendVerifySms($building_owner_number,$template_id,$parameters);
    }


    public function render()
    {
        return view('livewire.front.panel.components.technician.request-list');
    }
}
