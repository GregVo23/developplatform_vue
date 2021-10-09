<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailContact;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class ContactController extends Controller
{

    /**
     * Send an email to the administration.
     * There are 3 possibilities of subject chosen by the user: a question, a complaint or a normal e-mail mesage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
    {
        $email = env('MAIL_FROM_ADDRESS');
        $rules = array(

            'name' => 'required|string|min:3|max:80',
            'texte' => 'required|min:20|max:2000',
            'email' => 'required|string|email|max:100',
            'contact' => 'string|max:10',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect()->route('welcome')
                ->withErrors($validator)->withInput();
        } else {

            $admin = "";
            $message = "";
            $title = "";

            if (!empty($request->input('contact')) && $request->input('contact') == "question") {
                $admin = env('APP_EMAIL');
                $message = "Votre demande à été envoyée aux administrateurs du site, nous vous répondrons dans les plus brefs délais.";
                $title = "Question d'un membre de Developplatform";
            } elseif (!empty($request->input('contact')) && $request->input('contact') == "complaint") {
                $admin = env('APP_POLICE_EMAIL');
                $message = "Votre plainte à été envoyée aux personnes en charge des litiges du site, nous vous répondrons dans les plus brefs délais.";
                $title = "Plainte d'un membre de Developplatform";
            } else {
                $admin = env('APP_EMAIL');
                $message = "Votre message à été envoyée aux administrateurs du site, nous vous répondrons dans les plus brefs délais.";
                $title = "Message d'un membre de Developplatform";
            }
            $name = ucfirst($request->input('name'));
            $texte = $request->input('texte');
            $email = $request->input('email');
            $mailData = [
                'title' => $title,
                'name' => $name,
                'texte' => $texte,
                'email' => $email,
            ];
            Mail::to($admin)->send(new EmailContact($mailData));

            $request->session()->regenerate();
            Session::flash('success', $message);
            return redirect()->route('welcome')->with($message);
        }
    }
}
