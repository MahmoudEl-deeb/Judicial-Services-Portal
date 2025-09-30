<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;

#[Layout('layouts.dash')]
class DisplayService extends Component
{
    public function render()
    {
        try {
            $serviceRequests = DB::table('service_requests')
                ->where('requester_id', Auth::id())
                ->join('service_types', 'service_requests.service_type_id', '=', 'service_types.id')
                ->leftJoin('cases', 'service_requests.related_case_id', '=', 'cases.id')
                ->select('service_requests.*', 'service_types.service_name_ar as service_type_name', 'cases.case_number', DB::raw("CASE service_requests.status
                    WHEN 'pending' THEN 'قيد الانتظار'
                    WHEN 'under_department_review' THEN 'قيد مراجعة الدائرة'
                    WHEN 'assigned_to_secretary' THEN 'معينة للسكرتير'
                    WHEN 'in_progress' THEN 'قيد التنفيذ'
                    WHEN 'pending_approval' THEN 'في انتظار الموافقة'
                    WHEN 'approved' THEN 'تمت الموافقة'
                    WHEN 'rejected' THEN 'مرفوض'
                    WHEN 'completed' THEN 'مكتمل'
                    WHEN 'cancelled' THEN 'ملغى'
                    WHEN 'awaiting_payment' THEN 'في انتظار الدفع'
                    ELSE service_requests.status
                END as status_ar"))
                ->get();

            return view('livewire.pages.display-service', [
                'serviceRequests' => $serviceRequests
            ]);
        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Error fetching service requests: ' . $e->getMessage());
            // Optionally, you can set $serviceRequests to an empty collection or handle the error as needed
            $serviceRequests = collect();
            session()->flash('error', 'Unable to fetch service requests at this time.');
            return view('livewire.pages.display-service', [
                'serviceRequests' => $serviceRequests
            ]);
        }

    }
}
