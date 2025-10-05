<?php

namespace App\Livewire\Pages;

use App\Models\ServiceRequest;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

#[Layout('layouts.dash')]
class ViewServiceRequest extends Component
{
    public ServiceRequest $serviceRequest;

    public function mount($encodedid)
    {
        $id = base64_decode($encodedid);
        $this->serviceRequest = ServiceRequest::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pages.view-service-request');
    }

    public function downloadPdf()
    {
        $pdf = Pdf::loadView('pdf.service-request', ['serviceRequest' => $this->serviceRequest]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'service-request-' . $this->serviceRequest->id . '.pdf');
    }
}
