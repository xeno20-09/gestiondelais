<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Recours;
use Illuminate\Console\Command;
use App\Mail\MailPresidentRecours;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class notificationrecourspresidents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notificationrecourspresidents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $recours = Recours::whereMonth('date_enregistrement', Carbon::now()->month)
                ->whereYear('date_enregistrement', Carbon::now()->year)
                ->where('structure_id', 1/* Auth::user()->structure_id */)
                ->get();
            $user = Auth::user();
            Mail::to(/* $partie->conseiller->email */'allegressecakpo93@gmail.com')->send(
                new MailPresidentRecours(
                    $user,
                    $recours,
                )
            );
            return Command::SUCCESS;
        } catch (\Throwable $e) {
            Log::error('Erreur générale dans NotificationRecoursPresident : ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
