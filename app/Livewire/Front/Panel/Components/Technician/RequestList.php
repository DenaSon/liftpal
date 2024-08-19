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
    public $zoom;
    public $id;

    public function mount()
    {
        $this->request_list = Request::whereTechnicianId(\Auth::id())
            ->where('status', 'pending')
            ->get();

    }

    public function refreshList()
    {
        $this->request_list = Request::whereTechnicianId(\Auth::id())
            ->where('status', 'pending')
            ->get();
    }

    public function cancelRequest($id)
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

    public function zoomIn()
    {
        $this->zoom += 1;
    }

    public function render()
    {
        return view('livewire.front.panel.components.technician.request-list');
    }
}
