<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function candidateDash(){
        return view("dashboard.candidate_dash");
    }

    
    public function loginUser(User $user){
        request()->validate([
            "email" => "required|email",
            "password" => "required|min:5",
        ]);

        $existingUser = $user::where('email', request()->email)->first();
        if(!$existingUser){
            return back()->with("msg", "Sorry!, This account cannot be found");
        }

        if(Hash::check(request()->password, $existingUser->password)){ 
            session()->put("hr_id", $existingUser->id);
            dd("login");
            // return redirect("/find-matches")->with("first", "first");      
        }

        return back()->with("msg", "Password or Email is not correct!");     
    }

    public function registerUser(User $user, Request $request){
        request()->validate([
            "email" => "required|email|unique:users",
            "password" => "required|min:5|max:20",
            "username" => "required|min:5|unique:users",
        ]);


        $role = request()->query("role") ?? "user";
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->username = request()->username;
        $user->email = request()->email;
        $user->password = request()->password;
        $user->role = $role;
        $user->save();

        if($user){
            session()->put("hr_id", $user->id);
            // $this->sendMail($request, $user->id);
            return redirect("/steps");
        }
        
        return back()->with("msg", "something went wrong");
    }

    public function getUser($id){        
        $user = User::find($id);
        return $user;
    }
 
    public function searchUser(){  
        $query = request()->search;   
        $user = User::where("username", "like", "%$query%")
        ->orWhere("first_name", "like", "%$query%")
        ->orWhere("last_name", "like", "%$query%")
        ->orWhere("country", "like", "%$query%")
        ->get()
        ;
        $data["searchUser"] = $user;
        $data["isSearch"] = true;
        return view("pages.find-matches", compact("data"));
    }
  
 
    public function logOut(){
         session()->pull("hr_id");
         return redirect("/");
    }
 
    public function getAllUser(){        
        $user = User::all();
        return $user;
    }

    public function getUserByUsername($username){  
        $user = User::where('username', $username)->first();
        return $user;
    }

    public function updateUser(Request $request){
        $user = User::find(session("hr_id"));
        
        if(!$user){
            return "User Not Fuund" . session("admyrer_id");
        }
        
        $user->first_name = $request->first_name ?? $user->first_name;
        $user->last_name = $request->last_name ?? $user->last_name;
        $user->email = $request->email ?? $user->email;
        $user->username = $request->username ??  $user->username ;
        $user->avatar = $request->avatar ?? $user->avatar;
        $user->address = $request->address ?? $user->address;
        $user->gender = $request->gender ?? $user->gender ;
        $user->country = $request->country ?? $user->country;
        $user->state = $request->state ?? $user->state;
        $user->city = $request->city ?? $user->city;
        $user->unique_id = $request->unique_id ?? $user->unique_id;
        $user->bio = $request->bio ?? $user->bio;
        $user->location = $request->location ?? $user->location;
        $user->phone = $request->phone ?? $user->phone;
        $user->company_name = $request->company_name ?? $user->company_name;
        $user->company_branch = $request->company_branch ?? $user->company_branch;
        $user->salary = $request->salary ?? $user->salary;
        $user->title = $request->title ?? $user->title;
        $user->education = $request->education ?? $user->education;
        $user->is_verified = $request->is_verified ?? $user->is_verified;
        $user->comapny_type = $request->comapny_type ?? $user->comapny_type;
        $user->role = $request->role ?? $user->role;
        $user->cv = $request->cv ?? $user->cv;
        $user->experience = $request->experience ?? $user->experience;
        $user->skills = $request->skills ?? $user->skills;
        if($request->image){
            $photo = $this->uploadImage();
            $user->avatar = $photo;
        }

        $user->update();        
        return true;
    }

    public function uploadImage(){    
        $file = request()->file('image')->getRealPath();   
        $cloudinary = new Cloudinary();    
        $uploadedFileUrl = $cloudinary->uploadApi()->upload($file,);
        
        return $uploadedFileUrl["url"];
    }

    public function sendMail(Request $request, $id){
        $name = strtoupper($request->first_name);
        $message = $request->message;
        $email = $request->email;
        $subject = strtoupper($request->subject);
        $code = rand(1000, 9999);

        // $mail = Mail::to($email)->send(new VerifyMail($message, $subject, $email, $name, $code));
        // if(!$mail){
        //     false;
        // }

        $this->postCode($code, $id);
        return true;
    }

    // public function postCode($code, $id){
    //     $verify = new accountVerify();
    //     $verify->userId = session("admyrer_id") ?? $id;
    //     $verify->code = $code;
    //     $verify->save();

    //     return true;
    // }

    
    // public function verifyCode(accountVerify $verify){
    //     $code = $verify::where('code', request()->code)->first();
    //     if(!$code){
    //         return "Invalid code";
    //     }

    //     if($code->userId != session("admyrer_id")){
    //         return "Invalid code";
    //     }

    //     $code->delete();
    //     return true;
    // }

}
