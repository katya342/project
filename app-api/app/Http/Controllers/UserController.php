<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\NewTrainingNotification;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            // $path = $request->file('avatar')->store('avatars', 'public');
            $fileOriginalName = $request->file('avatar')->getClientOriginalName();
            $path = $request->file('avatar')->storeAs('public', $fileOriginalName);
           
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'avatar' => $path,
                'last_workout_check' => now(),
            ]);
        
            $token = $user->createToken("API TOKEN")->plainTextToken;
            $user->update(['remember_token' => $token]);
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $token,
            ], 200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function delete_account($userId){
        $user = new User();
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        else{
            $user->delete();
            return response()->json(['user' => 'User deleted succesfully'], 200);
        }
        
    }
    public function authorize(Request $request)
    {   
        
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
           
            $user = User::where('email', $request->email)->first();
            $user = auth()->user();
            
            $token = $user->createToken("API TOKEN")->plainTextToken;

            $user->update(['remember_token' => $token]);
            

            $user->notify(new NewTrainingNotification());


            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $token,
                'avatar' => $user->avatar,
            ], 200);
          


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
      
        
    }
       
    }
    

