<?php

namespace App\Console\Commands;

use App\Models\Fine;
use App\Models\EmiDeatil;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class AddLateEmiFine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emi:fine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Will get all emis which is not paid on their pay day and then add fine';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emis = EmiDeatil::whereYear('emi_month', Carbon::now())->whereMonth('emi_month', Carbon::now())->whereDate('emi_month', '<', Carbon::now())->whereStatus('pending')->get();
        
        foreach ($emis as $key => $emi) {
            $days = $this->diffBetweenDates($emi->emi_month, date('Y-m-d'));
            // $this->info($emi->emi_month);
            // $this->info($days);
            if($days < 5){
                $exists = Fine::where('emi_deatil_id', $emi->id)->exists();
                if(!$exists){
                    $data = [
                        'emi_deatil_id' => $emi->id,
                        'fine' => 250,
                    ];
                    Fine::create($data);
                }
            }

            if($days > 5){
                $data = [
                    'emi_deatil_id' => $emi->id,
                    'fine' => 50,
                ];
                Fine::create($data);
            }

        }
        return Command::SUCCESS;
    }

    public function diffBetweenDates($dateOne, $dateTwo)
    {
        $to = Carbon::createFromFormat('Y-m-d', $dateOne);
        $from = Carbon::createFromFormat('Y-m-d', $dateTwo);
        $days = $to->diffInDays($from);
        return $days;
    }
}
