<?php

namespace App\Livewire\Pages;

use App\Models\ServiceRequest;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.dash')]
class CreateService extends Component
{
    use WithFileUploads;

    public ServiceType $serviceType;
    public $request_title;
    public $request_description;
    public $documents = [];
    public $power_of_attorney;
    public $is_urgent_service = false;
    public $payment_method;
    public $base_fees_amount = 0;
    public $urgent_fees_amount = 0;
    public $total_fees_amount = 0;
    public $client_national_id;
    public $related_case_id = null;
    public $showSubmitConfirmation = false;
    public $rest_days = 0;
    public $processing_time = 0;

    public $userCases = [];

    public function mount($encodedid)
    {
        $id = base64_decode($encodedid);
        try {
            $this->serviceType = ServiceType::findOrFail($id);
            $this->calculateFeesAndTime();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    // public function loadUserCases()
    // {
    //     $user = Auth::user();
        
    //     if (method_exists($user, 'cases')) {
    //         $this->userCases = $user->cases()->get()->toArray();
    //     } else {
    //         $this->userCases = [];
    //     }
    // }

    public function calculateFeesAndTime()
    {
        // Calculate base fees from service type
        $this->base_fees_amount = $this->serviceType->base_fee ?? 0;
        
        // Calculate urgent fees using multiplier
        if ($this->is_urgent_service && $this->serviceType->allows_urgent) {
            $urgentMultiplier = $this->serviceType->urgent_fee_multiplier ?? 1.5;
    $this->urgent_fees_amount = ($this->base_fees_amount * $urgentMultiplier) - $this->base_fees_amount;
        } else {
            $this->urgent_fees_amount = 0;
            $this->is_urgent_service = false; 
        }
        
        $this->total_fees_amount = $this->base_fees_amount + $this->urgent_fees_amount;
        
        // Calculate processing time and rest days
        if ($this->is_urgent_service) {
            $this->processing_time = $this->serviceType->urgent_processing_days ?? 0;
        } else {
            $this->processing_time = $this->serviceType->processing_days ?? 0;
        }
        
        $this->rest_days = $this->processing_time;
    }

    public function updatedIsUrgentService($value)
    {
        $this->calculateFeesAndTime();
    }

    public function removeDocument($key)
    {
        if (isset($this->documents[$key])) {
            unset($this->documents[$key]);
        }
    }

    public function rules()
    {
        $rules = [
            'request_title' => 'required|string|max:255|min:10',
            'request_description' => 'required|string|min:20',
            'related_case_id' => 'nullable|exists:cases,id',
        ];

        if (Auth::user()->hasRole('lawyer')) {
            $rules['client_national_id'] = [
                'required', 
                'string', 
                'size:14',
                'regex:/^[2-3]\d{13}$/'
            ];
            $rules['power_of_attorney'] = 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240';
        }

        if ($this->serviceType->is_prepaid_service) {
            $rules['payment_method'] = 'required|in:online,bank_transfer';
        }

        if (!empty($this->serviceType->required_documents)) {
            foreach ($this->serviceType->required_documents as $key => $doc) {
                $rules['documents.' . $key] = 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240';
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'request_title.required' => 'حقل العنوان مطلوب',
            'request_title.min' => 'العنوان يجب أن يكون على الأقل 10 أحرف',
            'request_description.required' => 'حقل الوصف مطلوب',
            'request_description.min' => 'الوصف يجب أن يكون على الأقل 20 حرف',
            'client_national_id.required' => 'الرقم القومي للموكل مطلوب',
            'client_national_id.size' => 'الرقم القومي يجب أن يكون 14 رقم',
            'client_national_id.regex' => 'الرقم القومي غير صحيح',
            'power_of_attorney.required' => 'التوكيل مطلوب',
            'power_of_attorney.mimes' => 'نوع الملف غير مسموح به. المسموح: PDF, DOC, DOCX, JPG, JPEG, PNG',
            'power_of_attorney.max' => 'حجم الملف يجب ألا يتجاوز 10MB',
            'payment_method.required' => 'طريقة الدفع مطلوبة',
            'related_case_id.exists' => 'القضية المحددة غير موجودة',
            'documents.*.required' => 'هذا المستند مطلوب',
            'documents.*.mimes' => 'نوع الملف غير مسموح به. المسموح: PDF, DOC, DOCX, JPG, JPEG, PNG',
            'documents.*.max' => 'حجم الملف يجب ألا يتجاوز 10MB',
        ];
    }

   public function createServiceRequest()
{
    $this->validate();

    try {
        DB::beginTransaction();

        $user = Auth::user();

        // Calculate final fees and time
        $this->calculateFeesAndTime();

        // Prepare power of attorney path
        $powerOfAttorneyPath = '';

        // Create service request data
        $serviceRequestData = [
            'request_number' => 'SR-' . time() . '-' . rand(1000, 9999),
            'requester_id' => $user->id,
            'service_type_id' => $this->serviceType->id,
            'department_id' => $this->serviceType->responsible_department_id,
            'request_title' => $this->request_title,
            'request_description' => $this->request_description,
            'status' => 'pending_approval',
            'priority' => $this->is_urgent_service ? 'urgent' : 'normal',
            'is_urgent_service' => $this->is_urgent_service,
            'is_prepaid_service' => $this->serviceType->is_prepaid_service ?? false,
            'total_fees_amount' => $this->total_fees_amount,
            'payment_status' => 'pending',
            'client_national_id' => $this->client_national_id,
            'rest_days' => $this->rest_days,
            'payment_method' => $this->serviceType->is_prepaid_service ? $this->payment_method : null,
            'submitted_at' => now(),
            'power_of_attorney_path' => $powerOfAttorneyPath, // Set initial value
        ];

        // Add related case if provided and service requires it
        if ($this->serviceType->requires_case_reference && $this->related_case_id) {
            $serviceRequestData['related_case_id'] = $this->related_case_id;
        }

        // Create the service request
        $serviceRequest = ServiceRequest::create($serviceRequestData);

        // Upload power of attorney for lawyers and update the path
        if ($this->power_of_attorney) {
            $path = $this->power_of_attorney->store("service-requests/{$serviceRequest->id}", 'public');
            $serviceRequest->update(['power_of_attorney_path' => $path]);
        }

        // Upload required documents
        if (!empty($this->documents)) {
            foreach ($this->documents as $key => $document) {
                $path = $document->store("service-requests/{$serviceRequest->id}", 'public');
                
                $serviceRequest->documents()->create([
                    'document_name' => $this->serviceType->required_documents[$key],
                    'file_path' => $path,
                    'file_name' => $document->getClientOriginalName(),
                    'file_size' => $document->getSize(),
                    'mime_type' => $document->getMimeType(),
                ]);
            }
        }

        DB::commit();

        // Close the confirmation modal
        $this->showSubmitConfirmation = false;

        // Show success message
        session()->flash('message', 'تم إنشاء طلب الخدمة بنجاح وسيتم مراجعته من قبل الإدارة.');

        // Redirect to dashboard
        return redirect()->route('dashboard');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Service request creation failed: ' . $e->getMessage());
        
        // Close the confirmation modal on error
        $this->showSubmitConfirmation = false;
        
        session()->flash('error', 'حدث خطأ أثناء إنشاء الطلب: ' . $e->getMessage());
    }
}

    public function confirmSubmit()
    {
        $this->validate();
        $this->showSubmitConfirmation = true;
    }

    public function render()
    {
        return view('livewire.pages.create-service');
    }
}
