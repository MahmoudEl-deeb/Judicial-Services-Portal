<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\ServiceRequest;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class CalculateRestDays implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
             $query =  ServiceRequest::where('status', 'pending_approval')
            ->whereNotNull('expected_completion_date')
            ->chunkById(100, function ($services) {
                foreach ($services as $service) {
                    $restDays = Carbon::now()->diffInDays($service->expected_completion_date, false);
                    
                    $service->update([
                        'rest_days' => max($restDays, 0)
                    ]);
                }
            });
    }
}



class UpdateServiceStatus implements ShouldQueue
{

    public function handle()
    {
        // Get all approved services that are paid and past deadline
        $completedServices = ServiceRequest::where('status', 'approved')
            ->where('payment_status', 'paid')
            ->where('expected_completion_date', '<', Carbon::now())
            ->get();

        // Update their status to completed
        foreach ($completedServices as $service) {
            $service->update([
                'status' => 'completed',
                'completed_date' => Carbon::now()
            ]);
        }

        // Update rest days for all approved services

    }
}