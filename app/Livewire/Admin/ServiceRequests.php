<?php

namespace App\Livewire\Admin;

use App\Models\CassationDepartment;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.dash')]
class ServiceRequests extends Component
{
    use WithPagination;

    public $search = '';
    public $department_id = '';
    public $is_urgent = '';
    public ?ServiceRequest $editing = null;
    public $new_status = '';

    public function edit(ServiceRequest $serviceRequest)
    {
        $this->editing = $serviceRequest;
    }

    public function update()
    {
        $this->editing->update(['status' => $this->new_status]);
        $this->editing = null;
    }

    public function render()
    {
        $query = DB::table('service_requests')
            ->join('users', 'service_requests.requester_id', '=', 'users.id')
            ->join('service_types', 'service_requests.service_type_id', '=', 'service_types.id')
            ->leftJoin('cases', 'service_requests.related_case_id', '=', 'cases.id')
            ->select(
                'service_requests.*',
                'users.first_name',
                'users.last_name',
                'service_types.service_name_en',
                'cases.case_number'
            )
            ->when($this->search, function ($query) {
                $query->where('service_requests.request_number', 'like', '%' . $this->search . '%')
                    ->orWhere('users.first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->department_id, function ($query) {
                $query->where('service_requests.department_id', $this->department_id);
            })
            ->when($this->is_urgent !== '', function ($query) {
                $query->where('service_requests.is_urgent_service', $this->is_urgent);
            });

        $serviceRequests = $query->paginate(10);
        $departments = CassationDepartment::all();

        return view('livewire.admin.service-requests', [
            'serviceRequests' => $serviceRequests,
            'departments' => $departments,
        ]);
    }
}
