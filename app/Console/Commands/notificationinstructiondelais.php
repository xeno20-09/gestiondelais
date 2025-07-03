<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Mouvement;
use App\Mail\MailRappelDelais;
use Illuminate\Console\Command;
use function Laravel\Prompts\info;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        info('Rappel le:' . now());
        $today = Carbon::today();

        $mouvements = Mouvement::where('etat_instruction', 'Contacté')
            ->whereDate('date_fin_instruction', '<', $today)
            ->get();

        foreach ($mouvements as $mouvement) {
            $dateFin = Carbon::parse($mouvement->date_fin_instruction);
            $joursRestants = $today->diffInDays($dateFin, false);
            $this->getMessage($joursRestants, $mouvement, $dateFin);
        }
        return Command::SUCCESS;
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
        Mail::to($partie->greffier->email)->send(
            new MailRappelDelais(
                $mouvement->recours,
                $partie->greffier,
                $joursRestants
            )
        );

        Mail::to($partie->conseiller->email)->send(
            new MailRappelDelais(
                $mouvement->recours,
                $partie->conseiller,
                $joursRestants
            )
        );

        Mail::to($partie->auditeur->email)->send(
            new MailRappelDelais(
                $mouvement->recours,
                $partie->auditeur,
                $joursRestants
            )
        );

        // Tu pourrais ajouter d’autres envois ici si besoin
    }
}
