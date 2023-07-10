<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\EventNotification;
use App\Mail\Mail as MailMail;
use App\Models\Eleve;
use App\Models\Events;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Facades\Mail;

class Sendmail extends Command
{
    protected $signature = 'mail:send';
    protected $description = "Envoyer une notification d'événement par e-mail";
    public $event = [];
    public function handle()
    {
        $evenements = Events::all();
        $recipients = [];
        $eleves = Eleve::all()->where('etat', 1);
        foreach ($evenements as $evenement) {
            $event = [
                'titre'=>$evenement->libelle,
                'description'=>$evenement->description,
                'date'=>$evenement->date_Evenement,
            ];
        }
        
        foreach ($eleves as $Eleve) {
            $recipients[] = $Eleve->email;
            $event['sexEleve'] = $Eleve->sexe;
            // dd($event);
        }
        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new MailMail($event));
        }

        $this->info('Notifications d\'événement envoyées avec succès !');
    }
}
