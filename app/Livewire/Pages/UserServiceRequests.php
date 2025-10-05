<?php

// Last modified: 2025-10-01 00:28:00
namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

#[Layout('layouts.dash')]
class UserServiceRequests extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $statusFilter = '';
    public $searchQuery = '';

    // Computed properties للإحصائيات
    public function getCompletedCountProperty()
    {
        return DB::table('service_requests')
            ->where('requester_id', Auth::id())
            ->where('status', 'completed')
            ->count();
    }

    public function getInProgressCountProperty()
    {
        return DB::table('service_requests')
            ->where('requester_id', Auth::id())
            ->whereIn('status', ['in_progress', 'under_department_review', 'assigned_to_secretary'])
            ->count();
    }

    public function getPendingPaymentCountProperty()
    {
        return DB::table('service_requests')
            ->where('requester_id', Auth::id())
            ->where('payment_status', 'pending')
            ->count();
    }

    public function getTotalCountProperty()
    {
        return DB::table('service_requests')
            ->where('requester_id', Auth::id())
            ->count();
    }

    public function render()
    {
        try {
            $query = DB::table('service_requests as sr')
                ->where('sr.requester_id', Auth::id())
                ->join('service_types as st', 'sr.service_type_id', '=', 'st.id')
                ->leftJoin('cases as cc', 'sr.related_case_id', '=', 'cc.id')
                ->leftJoin('cassation_departments as cd', 'sr.department_id', '=', 'cd.id')
                ->select(
                    'sr.*',
                    'st.service_name_ar as service_type_name',
                    'cc.case_number',
                    'cd.department_name_ar as department_name',
                    DB::raw("CASE sr.status
                        WHEN 'pending' THEN 'قيد الانتظार'
                        WHEN 'under_department_review' THEN 'قيد مراجعة الدائرة'
                        WHEN 'assigned_to_secretary' THEN 'معينة للسكرتير'
                        WHEN 'in_progress' THEN 'قيد التنفيذ'
                        WHEN 'pending_approval' THEN 'في انتظار الموافقة'
                        WHEN 'approved' THEN 'تمت الموافقة'
                        WHEN 'rejected' THEN 'مرفوض'
                        WHEN 'completed' THEN 'مكتمل'
                        WHEN 'cancelled' THEN 'ملغى'
                        WHEN 'awaiting_payment' THEN 'في انتظار الدفع'
                        ELSE sr.status
                    END as status_ar"),
                    DB::raw("CASE sr.payment_status
                        WHEN 'pending' THEN 'بانتظار الدفع'
                        WHEN 'partial_paid' THEN 'مدفوع جزئياً'
                        WHEN 'paid' THEN 'مدفوع'
                        WHEN 'refunded' THEN 'تم الاسترجاع'
                        WHEN 'prepaid_balance_used' THEN 'مدفوع من الرصيد'
                        ELSE sr.payment_status
                    END as payment_status_ar"),
                    DB::raw("CASE 
                        WHEN sr.status = 'completed' THEN 'bg-green-100 text-green-800'
                        WHEN sr.status = 'in_progress' THEN 'bg-blue-100 text-blue-800'
                        WHEN sr.status = 'pending' THEN 'bg-yellow-100 text-yellow-800'
                        WHEN sr.status = 'rejected' THEN 'bg-red-100 text-red-800'
                        WHEN sr.status = 'awaiting_payment' THEN 'bg-purple-100 text-purple-800'
                        ELSE 'bg-gray-100 text-gray-800'
                    END as status_badge_class"),
                    DB::raw("CASE 
                        WHEN sr.payment_status = 'paid' THEN 'bg-green-100 text-green-800'
                        WHEN sr.payment_status = 'pending' THEN 'bg-yellow-100 text-yellow-800'
                        WHEN sr.payment_status = 'partial_paid' THEN 'bg-blue-100 text-blue-800'
                        ELSE 'bg-gray-100 text-gray-800'
                    END as payment_status_class"),
                    DB::raw("(SELECT COUNT(*) FROM service_request_documents WHERE service_request_id = sr.id) as documents_count")
                );

            // تطبيق الفلتر حسب الحالة
            if ($this->statusFilter) {
                $query->where('sr.status', $this->statusFilter);
            }

            // تطبيق البحث
            if ($this->searchQuery) {
                $query->where(function ($q) {
                    $q->where('sr.request_number', 'like', '%' . $this->searchQuery . '%')
                      ->orWhere('sr.request_title', 'like', '%' . $this->searchQuery . '%')
                      ->orWhere('st.service_name_ar', 'like', '%' . $this->searchQuery . '%')
                      ->orWhere('cc.case_number', 'like', '%' . $this->searchQuery . '%');
                });
            }

            $serviceRequests = $query->orderBy('sr.created_at', 'desc')
                                   ->paginate($this->perPage);

            return view('livewire.pages.user-service-requests', [
                'serviceRequests' => $serviceRequests
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching service requests: ' . $e->getMessage());
            
            // إنشاء paginator فارغ بدلاً من collection
            $serviceRequests = new LengthAwarePaginator([], 0, $this->perPage);
            session()->flash('error', 'Unable to fetch service requests at this time.');
            
            return view('livewire.pages.user-service-requests', [
                'serviceRequests' => $serviceRequests
            ]);
        }
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedSearchQuery()
    {
        $this->resetPage();
    }
}
