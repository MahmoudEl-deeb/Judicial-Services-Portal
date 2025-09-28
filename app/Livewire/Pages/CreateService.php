<?php

namespace App\Livewire\Pages;

use App\Models\ServiceType;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class CreateService extends Component
{
    public $serviceType;
    public $lawyers;
    public $selectedService;
    public $requiresLawyerSignature = false;
    public $selectedLawyer;
    public $request_title;
    public $request_description;

    public function mount($id)
    {
        try{
        $this->serviceType = ServiceType::find($id);
        $this->serviceType->required_documents = json_decode($this->serviceType->{'required_documents'}, true);

        $this->lawyers = User::role('lawyer')->get();
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            abort(404);
        }
    }

    public function updatedSelectedService($serviceId)
    {
        $service = ServiceType::find($serviceId);
        $this->requiresLawyerSignature = $service ? $service->requires_lawyer_signature : false;
    }

    public function createServiceRequest()
    {
        $this->validate([
            'selectedService' => 'required|exists:service_types,id',
            'request_title' => 'required|string|max:255',
            'request_description' => 'nullable|string',
            'selectedLawyer' => 'required_if:requiresLawyerSignature,true|exists:users,id',
        ]);

        // Create the service request
        // Note: This is a simplified example. You'll need to adapt it to your specific needs.
        $service = ServiceType::find($this->selectedService);
        $user = Auth::user();

        $serviceRequest = new \App\Models\ServiceRequest();
        $serviceRequest->request_number = uniqid('SR-');
        $serviceRequest->requester_id = $user->id;
        $serviceRequest->service_type_id = $service->id;
        $serviceRequest->department_id = $service->responsible_department_id;
        $serviceRequest->request_title = $this->request_title;
        $serviceRequest->request_description = $this->request_description;
        $serviceRequest->save();

        session()->flash('message', 'Service request created successfully.');

        $this->reset(['selectedService', 'selectedLawyer', 'request_title', 'request_description', 'requiresLawyerSignature']);
    }

    public function render()
    {
        return view('livewire.pages.create-service');
    }
}
