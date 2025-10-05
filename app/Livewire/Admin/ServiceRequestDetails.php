<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestDocument;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.dash')]
class ServiceRequestDetails extends Component
{
    public $serviceRequest;
    public $selectedDocument = null;
    public $showDocumentModal = false;
    public $showImageModal = false;
    public $selectedImagePath = '';
    public $selectedImageName = '';
    public $status;
    public $adminNotes = '';
    public $showStatusModal = false;

    protected $rules = [
        'status' => 'required|in:pending_approval,approved,rejected,completed',
        'adminNotes' => 'nullable|string|max:1000'
    ];

    public function mount($encodedId)
    {
        Log::info('Encoded ID received:', ['encoded' => $encodedId]);
        try {
        $id = base64_decode($encodedId);
        Log::info('Decoded ID:', ['id' => $id]);
        $this->serviceRequest = ServiceRequest::with([
            'requester',
            'serviceType',
            'department',
            'documents',
            'assignedSecretary',
            'approvedBySecretary',
            'relatedCase'
        ])->findOrFail($id);
         } catch (\Exception $e) {
        Log::error('Error decoding ID:', ['error' => $e->getMessage()]);
        abort(404);
    }

        $this->status = $this->serviceRequest->status;
        $this->adminNotes = $this->serviceRequest->department_notes;
    }

    public function viewDocument($documentId)
    {
        $this->selectedDocument = ServiceRequestDocument::find($documentId);
        $this->showDocumentModal = true;
    }

    public function viewImage($imagePath, $imageName)
    {
        $this->selectedImagePath = $imagePath;
        $this->selectedImageName = $imageName;
        $this->showImageModal = true;
    }

    public function closeImageModal()
    {
        $this->showImageModal = false;
        $this->selectedImagePath = '';
        $this->selectedImageName = '';
    }

    public function closeDocumentModal()
    {
        $this->showDocumentModal = false;
        $this->selectedDocument = null;
    }

    public function downloadDocument($documentId)
    {
        $document = ServiceRequestDocument::findOrFail($documentId);
        
        if (Storage::disk('public')->exists($document->file_path)) {
            return Storage::disk('public')->download($document->file_path, $document->document_name);
        }
        
        session()->flash('error', 'الملف غير موجود');
    }

    public function downloadCurrentImage()
    {
        if (Storage::disk('public')->exists($this->selectedImagePath)) {
            return Storage::disk('public')->download($this->selectedImagePath, $this->selectedImageName);
        }
        
        session()->flash('error', 'الصورة غير موجودة');
    }

    public function openStatusModal()
    {
        $this->showStatusModal = true;
    }

    public function closeStatusModal()
    {
        $this->showStatusModal = false;
    }

    public function updateStatusAction($status)
    {
        $this->status = $status;
        $this->updateStatus();
    }

    public function updateStatus()
    {
        $this->validate();

        try {
            $updateData = [
                'status' => $this->status,
                'department_notes' => $this->adminNotes
            ];
            
            // Update timestamps based on status
            switch ($this->status) {
                case 'approved':
                    $updateData['approved_date'] = now();
                    break;
                case 'completed':
                    $updateData['completed_date'] = now();
                    break;
                case 'rejected':
                    $updateData['rejection_reason'] = $this->adminNotes;
                    break;
            }

            $this->serviceRequest->update($updateData);

            session()->flash('message', 'تم تحديث حالة الطلب بنجاح');
            $this->closeStatusModal();

        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء تحديث حالة الطلب: ' . $e->getMessage());
        }
    }

    public function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    public function getStatusBadgeClass($status)
    {
        $classes = [
            'pending_approval' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'completed' => 'bg-green-100 text-green-800'
        ];

        return $classes[$status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusText($status)
    {
        $statuses = [
            'pending_approval' => 'بانتظار الموافقة',
            'approved' => 'مقبول',
            'rejected' => 'مرفوض',
            'completed' => 'مكتمل'
        ];

        return $statuses[$status] ?? $status;
    }

    public function viewPowerOfAttorney()
    {
        if ($this->serviceRequest->power_of_attorney_path && 
            Storage::disk('public')->exists($this->serviceRequest->power_of_attorney_path)) {
            
            $extension = pathinfo($this->serviceRequest->power_of_attorney_path, PATHINFO_EXTENSION);
            
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $this->selectedImagePath = $this->serviceRequest->power_of_attorney_path;
                $this->selectedImageName = 'التوكيل - ' . $this->serviceRequest->requester->first_name . ' ' . $this->serviceRequest->requester->last_name;
                $this->showImageModal = true;
            } else {
                $this->selectedDocument = (object)[
                    'id' => 'power_of_attorney',
                    'document_name' => 'التوكيل',
                    'file_path' => $this->serviceRequest->power_of_attorney_path,
                    'created_at' => $this->serviceRequest->created_at
                ];
                $this->showDocumentModal = true;
            }
        } else {
            session()->flash('error', 'ملف التوكيل غير موجود');
        }
    }

    public function downloadPowerOfAttorney()
    {
        if ($this->serviceRequest->power_of_attorney_path && 
            Storage::disk('public')->exists($this->serviceRequest->power_of_attorney_path)) {
            
            $fileName = 'التوكيل_' . $this->serviceRequest->requester->first_name . '_' . $this->serviceRequest->requester->last_name . '.' . pathinfo($this->serviceRequest->power_of_attorney_path, PATHINFO_EXTENSION);
            
            return Storage::disk('public')->download($this->serviceRequest->power_of_attorney_path, $fileName);
        }
        
        session()->flash('error', 'ملف التوكيل غير موجود');
    }

    public function render()
    {
        return view('livewire.admin.service-request-details');
    }
}
