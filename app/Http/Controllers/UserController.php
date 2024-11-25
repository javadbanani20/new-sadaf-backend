<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOtpCodeRequest;
use App\Http\Requests\OtpUserCodeRequest;
use App\Http\Resources\userOtpResource;
use App\Http\Resources\UserResource;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function checkUser(OtpUserCodeRequest $otpUserCodeRequest)
    {
        $user = User:: where('mobile' , $otpUserCodeRequest->mobile)->first();


        if($user){

            $OtpCode =   mt_rand('1000', '9999');

            $user_otp =  OtpCode::updateOrCreate(
                ['mobile' => $user->mobile],
                ['code' => $OtpCode],

            );


            return response()->json([
                'message' =>  'کابر با موففیت یافت شد و کد احراز هویت ارسال گردید',
                'date' => new userOtpResource($user_otp),

            ],200);
        }
        else {
            return response()->json([
                'message' => 'کاربری یافت نشد'
            ]) ;
        }
    }


    public function checkOtp(CheckOtpCodeRequest $checkOtpCodeRequest)
    {
        $user_ckeck_exits = OtpCode::where('mobile' , $checkOtpCodeRequest->mobile)
            ->where('code' , $checkOtpCodeRequest->code)->first();

        if ($user_ckeck_exits) {

            $user_ckeck_exits->delete();
            $user = User::where('mobile' ,$checkOtpCodeRequest->mobile)->first();

            $Token = $user->createToken('login' . ' - '  .$user->name);


            return response()->json([
                'message' =>  'کاربر با موفقیت وارد پنل شد',
                'date' => new UserResource($user),
                'token' => $Token->plainTextToken,

            ],200);


        }else {
            return response()->json([
                'message' => 'ورود کاربر نا موفق بود',
            ] );
        }
    }


    public function User_info(User $User)
    {
        return response()->json([
            'message' =>  'اطلاعات کاربر با موفقیت یافت شد',
            'date' => new UserResource($User),

        ]);
    }



}
