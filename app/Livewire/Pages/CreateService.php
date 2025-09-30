<?php

namespace App\Livewire\Pages;

use App\Models\ServiceRequest;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class CreateService extends Component
{
    use WithFileUploads;

    public ServiceType $serviceType;
    public $request_title;
    public $request_description;
    public $documents = [];

    public function mount($id)
    {
        try {
            $this->serviceType = ServiceType::findOrFail($id);
            $this->serviceType->required_documents = json_decode($this->serviceType->required_documents, true) ?? [];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function rules()
    {
        $rules = [
            'request_title' => 'required|string|max:255',
            'request_description' => 'required|string',
        ];

        if (is_array($this->serviceType->required_documents)) {
            foreach ($this->serviceType->required_documents as $key => $doc) {
                $rules['documents.' . $key] = 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240'; // 10MB Max
            }
        }

        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createServiceRequest()
    {
        try {
            $this->validate();

            $user = Auth::user();

            $serviceRequest = ServiceRequest::create([
                'request_number' => uniqid('SR-'),
                'requester_id' => $user->id,
                'service_type_id' => $this->serviceType->id,
                'department_id' => $this->serviceType->responsible_department_id,
                'request_title' => $this->request_title,
                'request_description' => $this->request_description,
                'status' => 'pending',
            ]);

            foreach ($this->documents as $key => $document) {
                $path = $document->store('service-request-documents', 'public');
                $serviceRequest->documents()->create([
                    'document_name' => $this->serviceType->required_documents[$key],
                    'file_path' => $path,
                ]);
            }

            session()->flash('message', 'Service request created successfully.');

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'An error occurred while creating the service request. Please try again.');
            return;
        }
    }

    public function render()
    {
        return view('livewire.pages.create-service');
    }
}
