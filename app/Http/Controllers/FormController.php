<?php

namespace App\Http\Controllers;
use App;
use Connections;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class FormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {

    }

    public function SendOnlyMail($request,$lang){

        $masters = $request->get('masters');
        $mailView = $request->mail_view;
        $close_button_text= $request->close_button_text;
        $accept_message = $request->accept_message;
        $custom_message = $request->custom_message;
        $custom_form = $request->custom_form;
        $subject    = $request->subject;
        $mail_backup = (boolean) $request->mail_backup;
        unset($request['subject']);
        unset($request['mail_backup']);
        unset($request['mail_status']);
        unset($request['mail_view']);
        unset($request['g-recaptcha-response']);
        unset($request['submit-form']);
        unset($request['close_button_text']);
        unset($request['accept_message']);
        unset($request['custom_message']);
        unset($request['process']);
        $requestAll = $request->all();
        $request->validate([
            'email' => 'required|email',
            'file.*' => 'mimes:jpg,jpeg,png,pdf,docx |max:4096'
        ]);

        $requestAll['accept_message'] = $accept_message;
        $requestAll['custom_message'] = $custom_message;
        $requestAll['mail_backup'] = $mail_backup;
        $status =  Connections::SendMail($subject,$requestAll,$mailView,$masters->mail_yonetimi->data->dynamic);
        if ($status == 1){
            return response()->json(['status'=> true,'message' => $accept_message, 'extra' => $close_button_text]);
        }else{
            return $status;
        }

    }

    public function InsertToMail($request,$lang){

        $masters = $request->get('masters');
        $mailView = $request->mail_view;
        $component = $request->componentId;
        $close_button_text= $request->close_button_text;
        $accept_message = $request->accept_message;
        $custom_message = $request->custom_message;
        $subject    = $request->subject;
        $mail_backup = (boolean) $request->mail_backup;
        unset($request['subject']);
        unset($request['mail_backup']);
        unset($request['mail_status']);
        unset($request['mail_view']);
        unset($request['componentId']);
        unset($request['g-recaptcha-response']);
        unset($request['submit-form']);
        unset($request['close_button_text']);
        unset($request['accept_message']);
        unset($request['custom_message']);
        unset($request['process']);
        $requestAll = $request->all();
        //return $requestAll;
        $insert     = Connections::DataInsert($component,$lang,$requestAll);


        if ($insert->status == true)
        {
            $requestAll['accept_message'] = $accept_message;
            $requestAll['custom_message'] = $custom_message;
            $requestAll['mail_backup'] = $mail_backup;
            $status =  Connections::SendMail($subject,$requestAll,$mailView,$masters->mail_yonetimi->data->dynamic);
            if ($status == 1){
                return response()->json(['status'=> true,'message' => $accept_message, 'extra' => $close_button_text]);
            }else{
                return $status;
            }
            //return response()->json($insert);
        }

    }

    public function FormPush(Request $request)
    {

        if (empty($request->get('g-recaptcha-response'))){
            return response()->json(['error' => 'Güvenlik Kodu Eksik!'], 401);
        }
        $lang = $request->get('lang');
        if ($request->has('process')){
            if ($request->get('process') == "Insert") {
                $component = $request->componentId;
                $close_button_text= $request->close_button_text;
                $accept_message = $request->accept_message;
                unset($request['componentId']);
                unset($request['g-recaptcha-response']);
                unset($request['close_button_text']);
                unset($request['accept_message']);
                unset($request['custom_message']);
                $requestAll = $request->all();
                $insert     = Connections::DataInsert($component,$lang,$requestAll);
                if ($insert->status == true)
                {
                    return response()->json(['status'=> true,'message' => $accept_message, 'extra' => $close_button_text]);
                }
                return response()->json($insert);

            }else if ($request->get('process') == "Update") {
                $recordId = $request->get('recordId');
                unset($request['g-recaptcha-response']);
                unset($request['process']);
                unset($request['recordId']);
                unset($request['close_button_text']);
                unset($request['accept_message']);
                $requestAll = $request->all();
                return  Connections::DataUpdate($recordId,$lang,$requestAll);
            }else if($request->get('process') == "Delete") {
                $recordId = $request->get('recordId');
                return Connections::DataDelete($recordId,$lang);
            }else if($request->get('process') == "InsertToMail") {
                return $this->InsertToMail($request,$lang);
            }
            else if($request->get('process') == "SendOnlyMail") {
                return $this->SendOnlyMail($request, $lang);
            }else{
                return 'Process Belirtilmemiş!';
            }
        }else{
            return $this->InsertToMail($request,$lang);
        }


    }


}
