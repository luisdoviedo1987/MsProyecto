<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EmailTemplate;

class EmailtemplateController extends Controller
{
    function updateWelcomeEmail(Request $request){
        $email_template = EmailTemplate::where('id', 1)->first();
        $email_template->subject = $request->subject;
        $email_template->content = $this->formatemails($request->description);
        $email_template->save();
        return view('admin.index')
                ->with('template', $email_template);
    }

    function updateReferEmail(Request $request){
        $email_template = EmailTemplate::where('id', 2)->first();
        $email_template->subject = $request->subject;
        $email_template->content = $this->formatemails($request->description);
        $email_template->save();
        return view('admin.refer')
                ->with('template', $email_template);
    }

    function updatePasswordEmail(Request $request){
        $email_template = EmailTemplate::where('id', 3)->first();
        $email_template->subject = $request->subject;
        $email_template->content = $this->formatemails($request->description);
        $email_template->save();
        return view('admin.pass')
                ->with('template', $email_template);
    }

    function upatedSmsText(Request $request){
        $email_template = EmailTemplate::where('id', 4)->first();
        $email_template->content = $this->formatemails($request->description);
        $email_template->save();
        return view('admin.sms')
                ->with('template', $email_template);
    }

    function formatemails($content){
        $content = str_replace("'", "\'", $content);
        $content = str_replace("\n", '', $content);
        return $content;
    }
}
