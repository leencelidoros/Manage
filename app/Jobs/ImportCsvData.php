<?php

namespace App\Jobs;

use App\Models\Employee;
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldBeUnique;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Foundation\Bus\Dispatchable;
//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Queue\SerializesModels;
use App\Models\Supermarket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCsvData implements ShouldQueue
{
   // use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $supermarket;
    protected $csvData;

    public function __construct(Supermarket $supermarket, array $csvData)
    {
        $this->supermarket = $supermarket;
        $this->csvData = $csvData;
    }
    /**
     * Create a new job instance.
     */

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        {
            // Logic to import the CSV data into the database for the specified supermarket
            $csvData = $this->csvData;
            $manager = $this->manager;

            foreach ($csvData as $row) {
                // Process each row of the CSV data and store it in the database
                $employee = new Employee();
                $employee->name = $row['name'];
                $employee->email = $row['email'];
                $employee->manager_id = $manager->id;
                $employee->save();
            }
        }
    }
}
