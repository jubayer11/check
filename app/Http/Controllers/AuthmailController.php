<?php

namespace App\Http\Controllers;

use App\Http\Requests\forgetPasswordEmailSentRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
class AuthmailController extends Controller
{
    //

    use SendsPasswordResetEmails;
    public function sendPasswordResetLink(forgetPasswordEmailSentRequest $request)
    {


        return $this->sendResetLinkEmail($request);
    }
    protected function sendResetLinkResponse(Request $request, $response)
    {

        return response()->json([
            'message' => 'An email has been sent to you to reset your password.',
            'data' => $response
        ]);
    }
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Email could not be sent to this email address.']);
    }
    public function gettingtoken($token){
        return view('resetPassword',compact('token'));
    }
}
