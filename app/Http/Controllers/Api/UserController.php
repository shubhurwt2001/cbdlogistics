<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\ResetUserPasswordMail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserVerify;
use App\Models\UserDetail;
use App\Models\Category;
use App\Models\Country;
use App\Models\Page;
use Mail;
use DB;


class UserController extends Controller
{

    public function register(Request $request)
    {
        
           $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $token = Str::random(64);

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->status = 1;
        $user->save();

        $userDetail = new UserDetail();
        $userDetail->user_id = $user->id;
        $userDetail->dob = $request->dob;
        $userDetail->gender = $request->gender;
        $userDetail->city = $request->city;
        $userDetail->state = $request->state;
        $userDetail->country = $request->country;
        $userDetail->zipcode = $request->zipcode;
        $userDetail->save();

        // $userVerify = new UserVerify();
        // $userVerify->user_id = $user->id;
        // $userVerify->token = $token;
        // $userVerify->save();


        // Mail::send('emails.user-email-verification', ['token' => $token , 'email'=> $request->email], function($message) use($request){
        //     $message->to($request->email);
        //     $message->subject('Email Verification Mail');
        // });

        $userData = User::select('users.*', 'user_details.*')->leftJoin('user_details', 'users.id', 'user_details.user_id')->where('users.id',$user->id)->first();
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'user' => $userData,
            'token_type' => 'Bearer',
            'token' => $token

        ]);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),
        [
            'email' => 'required',
            'password' => 'required',
        ], 
        [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required'
        ]
       );
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
       

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;

            $userData = User::select('users.*', 'user_details.*')->leftJoin('user_details', 'users.id', 'user_details.user_id')->where('users.email',$request->email)->first();

            // $userData->device_token = $request->device_token;
            // $userData->device_type = $request->device_type;
            // $userData->longitude = $request->longitude;
            // $userData->latitude = $request->latitude;
            // $userData->save();

            $response = ['success' => true, 'message' => 'Login successfully', 'user' => $userData, 'token_type' => 'Bearer', 'token' => $token];
            return response()->json($response, 200);
        } else {
            return response()->json(['message' => 'Unauthorised', 'success' => false], 401);
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'email' => 'required|email',
        ], 
        [
            'email.required' => 'Email is required',
            
        ]
       );
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $countUser = User::where('email',$request->email)->where('status',1)->count();
        if ($countUser < 1) {
            $response = ['success' => false, 'message' => 'User does not exist'];
            return response()->json($response, 200);
        }
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

         $arr = [
            'email' => $request->email,
            'token' => $token,
         ];
        Mail::to($request->email)->send(new ResetUserPasswordMail($arr));

        $response = ['success' => true, 'message' => 'We have e-mailed your password reset link'];
        return response()->json($response, 200);
    }


    public function createAuth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $userCount = User::where('email', $request->email)->count();
        if ($userCount == 0) {
            $user = new User();
            $user->email = $request->email;
            $user->password = bcrypt('cbdlogistics');
            $user->firstname = '';
            $user->lastname = '';
            $user->mobile = '';
            $user->status = 1;
            $user->save();

            $userDetail = new UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->save();


            $token = $user->createToken('LaravelAuthApp')->accessToken;
        } else {
            $user = User::where('email', $request->email)->first();
            // $user->device_token = $request->device_token;
            // $user->device_type = $request->device_type;
            // $user->longitude = $request->longitude;
            // $user->latitude = $request->latitude;
            // $user->save();
            $token = $user->createToken('LaravelAuthApp')->accessToken;
        }

        $userData = User::select('users.*', 'user_details.*')->leftJoin('user_details', 'users.id', 'user_details.user_id')->where('users.email',$request->email)->first();


        return response()->json([
            'success' => true,
            'message' => 'Auth created successfully',
            'user' => $userData,
            'token_type' => 'Bearer',
            'token' => $token

        ]);
    }

    public function userDetails(Request $request)
    {
        $user_id = auth('api')->user()->id;
        ///return $user_id;
        $user = User::select('users.*', 'user_details.*')->leftJoin('user_details', 'users.id', 'user_details.user_id')->where('users.id',$user_id)->first();

        $response = [
            'success' => true,
            'message' => 'User Detail',
            'user' => $user,
        ];

        return response()->json($response, 200);
    }




    public function getCountries(Request $request)
    {
        $countries = Country::select('id', 'iso', 'name', 'nicename', 'iso3', 'numcode', 'phonecode')->get();
        $response = [
            'success' => true,
            'message' => 'Country list',
            'countries' => $countries,
        ];

        return response()->json($response, 200);
    }



    public function updateUserProfile(Request $request)
    {
        $user_id = auth('api')->user()->id;
        $user = User::where('id', $user_id)->first();

        if ($files = $request->file('image')) {
            if (\File::exists(public_path('uploads/users/' . $user->image))) {
                \File::delete(public_path('uploads/users/' . $user->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/users/'), $imageName);
        } else {
            $imageName = $user->profile_img;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->profile_img = $imageName;
        $user->save();


        $uDetail = UserDetails::where('user_id', $user_id)->first();
        $userDetail = UserDetails::find($uDetail->id);
        $userDetail->city = $request->city;
        $userDetail->save();

        $response = [
            'success' => true,
            'message' => 'Profile updated successfully',
            'user' => $user,
        ];

        return response()->json($response, 200);
    }





    function changePassword(Request $request)
    {

        $validator = Validator::make($request->all(),
        [
            'new_password' => 'required',
            'old_password' => 'required',
        ], 
        [
            'new_password.required' => 'new password is required',
            'old_password.required' => 'old password is required',
            
        ]
       );
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }


        $data = $request->all();
        $user = Auth::guard('api')->user();
        if (isset($data['old_password']) && !empty($data['old_password']) && $data['old_password'] !== "" && $data['old_password'] !== 'undefined') {
            $check  = Auth::guard('web')->attempt([
                'email' => $user->email,
                'password' => $data['old_password']
            ]);

            if ($check && isset($data['new_password']) && !empty($data['new_password']) && $data['new_password'] !== "" && $data['new_password'] !== 'undefined') {
                $user->password = bcrypt($data['new_password']);
                $user->token()->revoke();
                $token = $user->createToken('newToken')->accessToken;
                $user->save();
                $response = ['success' => true, 'message' => 'password changed successfully', 'user' => $user, 'token_type' => 'Bearer', 'token' => $token];
            } else {
                $response = ['success' => false, 'message' => 'Invalid password.', 'user' => $user];
            }
        }
        return response()->json($response, 200);
    }


 

    public function about(Request $request)
    {
        $data = Page::where(['status' => 1, 'id' => 1])->first();
        $response = ['title' => $data->title, 'descriptions' => $data->descriptions, 'success' => true];
        return response()->json($response, 200);
    }

    public function privacyPolicy(Request $request)
    {
        $data = Page::where(['status' => 1, 'id' => 2])->first();
        $response = ['title' => $data->title, 'descriptions' => $data->descriptions, 'success' => true];
        return response()->json($response, 200);
    }


    public function termsConditions(Request $request)
    {
        $data = Page::where(['status' => 1, 'id' => 3])->first();
        $response = ['title' => $data->title, 'descriptions' => $data->descriptions, 'success' => true];
        return response()->json($response, 200);
    }

    public function logout(Request $request)
    {
        $user = auth('api')->user()->token();
        $user->revoke();
        $response = ['message' => 'Logout successfully', 'success' => true];
        return response()->json($response, 200);
    }


    public function sendNotification(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();  
       /// $user_id = Auth::guard('api')->user()->id;
       /// $user = User::whereNotNull('device_token')->where('id',$user_id)->first();  
       /// $firebaseToken = $user->device_token;
        $SERVER_API_KEY = env('FIREBASE_SERVER_KEY');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,  
            ]
        ];
        $dataString = json_encode($data);
       
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $responseNotify = curl_exec($ch);
        $response = ['success' => true,'message' => 'Firebase Notification','response'=>$responseNotify];
        return response()->json($response, 200);

    }
    
}
