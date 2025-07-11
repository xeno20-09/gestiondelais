<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Mouvement;
use App\Mail\MailRappelDelais;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class notificationinstructiondelais extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notificationinstructiondelais';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rappel pour délais des mesures d\'instruction';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        try {
            $today = Carbon::today();

            $mouvements = Mouvement::where('etat_instruction', 'Contacté')
                ->whereDate('date_fin_instruction', '<', $today)
                ->get();

            foreach ($mouvements as $mouvement) {
                try {
                    $dateFin = Carbon::parse($mouvement->date_fin_instruction);
                    $joursRestants = $today->diffInDays($dateFin, false);

                    $this->getMessage($joursRestants, $mouvement, $dateFin);
                } catch (\Throwable $e) {
                    Log::error('Erreur sur un mouvement : ' . $e->getMessage());
                }
            }

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            Log::error('Erreur générale dans NotificationInstructionDelais : ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Prépare le message en fonction des jours restants.
     */
    private function getMessage(int $joursRestants, Mouvement $mouvement, Carbon $dateFin): void
    {
        if ($joursRestants < 0) {
            $joursRestants = ($joursRestants * (-1));
        }
        $partie = $mouvement->recours->partie;
        /* Mail::to( $partie->greffier->email 'allegressecakpo93@gmail.com')->send(
            new MailRappelDelais(
                $mouvement->recours,
                $partie->greffier,
                $joursRestants
            )
        );*/

        Mail::to(/* $partie->conseiller->email */'allegressecakpo93@gmail.com')->send(
            new MailRappelDelais(
                $mouvement->recours,
                $partie->conseiller,
                $joursRestants
            )
        );

        Mail::to(/* $partie->auditeur->email */'adelecakpo150@gmail.com')->send(
            new MailRappelDelais(
                $mouvement->recours,
                $partie->auditeur,
                $joursRestants
            )
        );

        // Tu pourrais ajouter d’autres envois ici si besoin
    }
}
