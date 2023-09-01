<?php

namespace App\Console\Commands;
use Illuminate\Console\Command; use App\Models\HrisEmployeePresence; use App\Models\HrisEmployee; 
use Carbon\Carbon;
use Illuminate\Support\Str;

class GenerateEmployeePresence extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string */
    protected $signature = 'generate-employee-presence:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Absensi Karyawan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Cron is generate absensi fine! - START");
	$dateTarget = Carbon::now()->format('Y-m-d');
//	$dateTarget = '2023-07-02';
	
        $dataEmployee = HrisEmployee::actived()
            ->whereDoesntHave('hrisEmployeePresence', function($query) use ($dateTarget){
                $query->where('presence_date', $dateTarget);
            })
            ->get();

        foreach($dataEmployee as $employee) {
             \Log::info("EMPLOYEE : " . $employee->name);
            HrisEmployeePresence::create([
                'uuid' => Str::uuid(),
                'hris_employee_id' => $employee->id,
                'presence_date' => $dateTarget,
                'drafted' => true,
                'actived' => false,
            ]);
        }

        \Log::info("Cron is generate absensi fine! - END");
    }
}
