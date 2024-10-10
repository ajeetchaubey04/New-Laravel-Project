<?php

namespace App\Http\Controllers\Api\V1\Client\Auth;

use App\Models\BuyNow;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\PasswordReset;
use App\Notifications\RequestStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait;

    const TYPE = 'client';

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(Self::TYPE);
    }

    /**
     * login
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email'     =>    'required',
                'password'  =>    'required|min:8',
                'type'      =>    'required',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Email / Adhar or Password !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $field = is_numeric($request->email) ? 'adhar_card_no' :  'email';
        $field == 'adhar_card_no' ?  request()->merge([$field => $request->email]) : '';
        $user = Client::where($field, $request->email)->first();

        if ($user && $user->status == 1 && $request->type ==  $user->type) {
            if (Self::guard()->attempt($request->only([$field, 'password']))) {

                $user->device_token = $request->device_token;
                $user->save();
                
                if($user->type == 'customer'){
                    $buyNow = BuyNow::select('device_name', 'device_id')->whereClientId($user->id)->first();
                    $user['device_model'] = $buyNow->device_id;
                    $user['device_name'] = $buyNow->device_name;
                }

                $user['token'] = $user->createToken('client', ['client:' . $user->type])->plainTextToken;
                $user['privacy_policy'] = route('privacy-policy');
                $user['terms_conditions'] = route('terms-conditions');
                return $this->responseSuccess($user, 'Login Successfull', Response::HTTP_OK);
            }
            return $this->responseError(['password' => "Password doesn't Match"], "Password doesn't Match", Response::HTTP_UNAUTHORIZED);
        }

        return $this->responseError([], 'Account Not Found or Account Not Active or Account Type Mismatch !!', Response::HTTP_NOT_FOUND);
    }


    /**
     * Send Verification Code
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function sendVerificationCode(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'user_id'   =>    'required',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Data !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = Client::with('sale')->whereId($request->user_id)->first();

        //  if customer then add a random code and sent notification to sales person
        if ($user->type == 'customer') {
            $code = Str::random(6);
            Client::whereId($user->id)->update(['code' => $code]);

            if ($user->sale) {
                $data = ['body' => 'Hi '.$user->sale->name.' this is customer '.$user->name.'( '. $user->phone.' ) verification code ' . $code, 'title' => $user->name.' Verification Code', 'type' => 'customer_verification_code'];
                try {
                    Notification::route('fcm', $user->sale->device_token)->notify(new RequestStatus($data));
                } catch (\Throwable $th) {
                    return $this->responseSuccess($th, 'Token Expired', Response::HTTP_OK);
                }
                unset( $user->sale);
                return $this->responseSuccess($user, 'Otp Send to Sale Rep !!', Response::HTTP_NOT_FOUND);
            }
        }

        return $this->responseError([], 'Please Send valid User Id !!', Response::HTTP_NOT_FOUND);
    }

    /**
     * Verify Code
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function verifyCode(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'user_id'   =>    'required',
                'code'      =>    'required|min:6|max:6',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Code !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = Client::whereId($request->user_id)->whereCode($request->code)->first();

        if ($user) {
            $user->code_verified = 1;
            $user->save();
            return $this->responseSuccess($user, 'Code Verified', Response::HTTP_OK);
        }

        return $this->responseError([], 'Code Mismatch !!', Response::HTTP_NOT_FOUND);
    }

    /**
     * Register
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function register(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name'      =>   'required',
                'phone'     =>   'required|min:10|max:10|unique:clients',
                'email'     =>   'required|email|unique:clients',
                'password'  =>   'required|min:8',
                'type'      =>   'in:customer,sales-person',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Data !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $insert = [
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'type'      => $request->type ?? 'sales-person',
        ];

        $user = Client::create($insert);

        return $this->responseSuccess([], 'Thank you !! Account Created Admin Verify And Activate Your Account.', Response::HTTP_OK);
    }

    /**
     * Change Password
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function changePassword(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'password'      =>   'required|min:8',
                'new_password'  =>   'required|min:8|confirmed',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Data !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (Hash::check($request->password, Auth::user()->password)) {
            Client::whereId(Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);
            return $this->responseSuccess([], 'Password Changed Successfully !!', Response::HTTP_OK);
        }

        return $this->responseError([], 'Current Password Not Matched !!', Response::HTTP_NOT_FOUND);
    }

    /**
     * Forgot Password
     *
     * @param  mixed $request Array | []
     * @return void
     **/

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|exists:clients',
            ]
        );

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Invalid Data !', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token
        ]);

        $link = route('client.reset-password.get', $token);
        Notification::route('mail', $request->email)->notify(new PasswordReset($link));
        return $this->responseSuccess([], 'Check Your Email To Reset Password !!', Response::HTTP_OK);
    }

    /**
     * My Deatils
     *
     * @param  mixed $request Array | []
     * @return void
     */

    public function myDeatils(Request $request)
    {
        return $this->responseSuccess($request->user(), 'My Details !!', Response::HTTP_OK);
    }
}
