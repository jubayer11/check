<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Requests\loginRequest;
use App\Http\Requests\SignupRequest;
use App\Notifications\newUserNotification;
use App\User;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class AuthController extends Controller
{
    use HasRoles;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

      use ResetsPasswords;

    public function __construct()
    {
       $this->middleware('JWT', ['except' => ['login','signup','sendResetFailedResponse','sendResetResponse','callResetPassword','resetPassword']]);
    }
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Failed, Invalid Token.']);
    }
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Password reset successfully.']);
    }
    public function callResetPassword(Request $request)
    {
        return $this->reset($request);
    }
    protected function resetPassword($user, $password)
    {

        $user->password = $password;
        $user->save();
        event(new PasswordReset($user));
    }


    public function login(loginRequest $request)
    {

        $credentials = request(['email', 'password']);
        if (! $token = auth()->attempt($credentials,['exp' => Carbon::now()->addDays(7)->timestamp])) {
            return response()->json(['errors' => ['wrong'=>'This Password Does not match']], 401);
        }

        $users = DB::table('users')->where('email', '=', $credentials['email'])->first();

         if($users->status !=1){
             return response()->json(['errors' => ['status'=>'You have not been accepted yet']], 401);
         }

        return $this->respondWithToken($token,$request);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    public function signup(SignupRequest $request)
    {

        $user=new User();
       $user->first_name=$request->first_name;
       $user->last_name=$request->last_name;
       $user->email=$request->phone;
       $user->phone=$request->email;
       $user->password=$request->password;
       $user->save();
       $user->assignRole($request->role);
       $admins=User::role('Admin')->get();
        foreach($admins as $admin) {
            $admin->notify(new newUserNotification($user));
            }
        }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token,$request)
    {
        auth()->user()->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
        $lmsclass=auth()->user()->lmsclass();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'Role'=>auth()->user()->getRoleNames()->first(),
            'user'=> $lmsclass,

        ]);
    }
    public function username(){
        return 'phone';
    }
}
