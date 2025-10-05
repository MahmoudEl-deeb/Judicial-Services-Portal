<?php

namespace App\Livewire\Pages;

use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Payment extends Component
{
    public ServiceRequest $serviceRequest;

    public function mount($encodedserviceRequest)
    {
        $decodedId = base64_decode($encodedserviceRequest);
        try {
            $serviceRequest = ServiceRequest::findOrFail($decodedId);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
        $this->serviceRequest = $serviceRequest;
    }

    public function processPayment()
    {
        // In a real application, you would integrate with a payment gateway here.
        // For this example, we'll simulate a successful payment.

        try {
            $this->serviceRequest->update([
                'payment_status' => 'paid',
            ]);

            session()->flash('message', 'Payment successful. Your service request has been submitted.');

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'An error occurred while processing the payment. Please try again.');
            return;
        }
    }

    public function render()
    {
        return view('livewire.pages.payment');
    }
}
