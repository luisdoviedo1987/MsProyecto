<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Mail\Mailer;

use App\EmailTemplate;

class SendNewReferEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $email_template = EmailTemplate::where('id', 2)->first();
        $body = $email_template->content;
        $body = str_replace('{nombreReferente}', $this->data['nombreReferente'], $body);
        $body = str_replace('{apellidoReferente}', $this->data['apellidoReferente'], $body);
        $body = str_replace('{url_afiliacion}', $this->data['url_afiliacion'], $body);
        $body = str_replace('{codigoReferido}', $this->data['codigoReferido'], $body);
        $mailer->send([], $this->data, function ($message) use($body, $email_template) {
            $message->from('manage@medismart.net', 'Gestión Medismart');
            $message->to($this->data['email'])->subject($email_template->subject);
            $message->setBody($body,'text/html');
        });

        // $mailer->send('email.refer', $this->data, function ($message) {
        //     $message->from('manage@medismart.net', 'Gestión Medismart');
        //     $message->to($this->data['email'])
        //             ->subject('Te han referido');
        // });
    }
}
