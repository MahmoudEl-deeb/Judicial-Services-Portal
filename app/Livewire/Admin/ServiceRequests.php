<?php

namespace App\Livewire\Admin;

use App\Models\CassationDepartment;
use App\Models\ServiceRequest;
use App\Models\ServiceType;
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
    public $status = '';
    public $service_type_id = '';
    public $date_from = '';
    public $date_to = '';
    public ?ServiceRequest $editing = null;
    public $new_status = '';

    public function edit(ServiceRequest $serviceRequest)
    {
        $this->editing = $serviceRequest;
        $this->new_status = $serviceRequest->status;
    }

    public function update()
    {
        $this->validate([
            'new_status' => 'required|in:pending_approval,approved,rejected,completed,awaiting_payment'
        ]);

        $this->editing->update(['status' => $this->new_status]);
        $this->editing = null;
        $this->new_status = '';
        
        session()->flash('message', 'تم تحديث حالة الطلب بنجاح');
    }

    public function resetFilters()
    {
        $this->reset(['search', 'department_id', 'is_urgent', 'status', 'service_type_id', 'date_from', 'date_to']);
        $this->resetPage();
    }

    public function render()
{
    $query = DB::table('service_requests')
        ->join('users', 'service_requests.requester_id', '=', 'users.id')
        ->join('service_types', 'service_requests.service_type_id', '=', 'service_types.id')
        ->leftJoin('cases', 'service_requests.related_case_id', '=', 'cases.id')
        ->leftJoin('model_has_roles', function($join) {
            $join->on('users.id', '=', 'model_has_roles.model_id')
                 ->where('model_has_roles.model_type', '=', 'App\Models\User');
        })
        ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select(
            'service_requests.*',
            'users.first_name',
            'users.last_name',
            'users.email',
            'roles.name as role_name',
            'service_types.service_name_ar',
            'service_types.service_name_en',
            'service_types.is_prepaid_service',
            'cases.case_number'
        )
        ->when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('service_requests.request_number', 'like', '%' . $this->search . '%')
                  ->orWhere('service_requests.request_title', 'like', '%' . $this->search . '%')
                  ->orWhere('users.first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('users.last_name', 'like', '%' . $this->search . '%')
                  ->orWhere('users.email', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->department_id, function ($query) {
            $query->where('service_requests.department_id', $this->department_id);
        })
        ->when($this->is_urgent !== '', function ($query) {
            $isUrgent = $this->is_urgent === 'true' ? 1 : 0;
            $query->where('service_requests.is_urgent_service', $isUrgent);
        })
        ->when($this->status, function ($query) {
            $query->where('service_requests.status', $this->status);
        })
        ->when($this->service_type_id, function ($query) {
            $query->where('service_requests.service_type_id', $this->service_type_id);
        })
        ->when($this->date_from, function ($query) {
            $query->whereDate('service_requests.created_at', '>=', $this->date_from);
        })
        ->when($this->date_to, function ($query) {
            $query->whereDate('service_requests.created_at', '<=', $this->date_to);
        })
        // Filter for prepaid services with pending payment
        ->when(true, function ($query) {
            $query->where(function ($q) {
                $q->where('service_types.is_prepaid_service', 0)
                  ->orWhere(function ($subQ) {
                      $subQ->where('service_types.is_prepaid_service', 1)
                           ->where('service_requests.payment_status', 'paid');
                  });
            });
        })
        // Order by rest_days with 0 values last
        ->orderByRaw('CASE WHEN service_requests.rest_days = 0 THEN 1 ELSE 0 END')
        ->orderBy('service_requests.rest_days', 'asc');

    $serviceRequests = $query->paginate(10);
    $departments = CassationDepartment::all();
    $serviceTypes = ServiceType::all();

    // Get counts using the same base query for consistency
    $baseQuery = DB::table('service_requests')
        ->join('service_types', 'service_requests.service_type_id', '=', 'service_types.id')
        ->where(function ($q) {
            $q->where('service_types.is_prepaid_service', 0)
              ->orWhere(function ($subQ) {
                  $subQ->where('service_types.is_prepaid_service', 1)
                       ->where('service_requests.payment_status', 'paid');
              });
        });

    $totalRequests = (clone $baseQuery)->count();
    $pendingRequests = (clone $baseQuery)->where('service_requests.status', 'pending_approval')->count();
    $urgentRequests = (clone $baseQuery)->where('service_requests.is_urgent_service', true)->count();
    $completedRequests = (clone $baseQuery)->where('service_requests.status', 'completed')->count();

    return view('livewire.admin.service-requests', [
        'serviceRequests' => $serviceRequests,
        'departments' => $departments,
        'serviceTypes' => $serviceTypes,
        'totalRequests' => $totalRequests,
        'pendingRequests' => $pendingRequests,
        'urgentRequests' => $urgentRequests,
        'completedRequests' => $completedRequests,
    ]);
}
}