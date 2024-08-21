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
        }
        catch (Throwable $e) {
            $this->alert('error', $e->getMessage());
        }
    }



    public function render()
    {
        return view('livewire.front.panel.components.technician.request-list');
    }
}
