<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Mail\Mailer;

use App\EmailTemplate;

class SendUpdatePassEmail implements ShouldQueue
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
        $email_template = EmailTemplate::where('id', 3)->first();
        $body = $email_template->content;
        $body = str_replace('{link}', $this->data['link'], $body);
        $mailer->send([], $this->data, function ($message) use($body, $email_template) {
            $message->from('manage@medismart.net', 'Recuperar contraseña');
            $message->to($this->data['email'])->subject($email_template->subject);
            $message->setBody($body,'text/html');
        });

        // $mailer->send('email.updatepass', $this->data, function ($message) {
        //     $message->from('manage@medismart.net', 'Recuperar contraseña');
        //     $message->to($this->data['email'])
        //             ->subject($this->data['title']);
        // });
    }
}
