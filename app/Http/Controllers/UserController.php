<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function candidateDash(){
        $data["user"] = $this->getUser(session("hr_id"));
        return view("dashboard.candidate_dash", compact("data"));
    }

    public function employersDash(){
        $data["user"] = $this->getUser(session("hr_id"));
        return view("dashboard.employers_dash", compact("data"));
    }

    public function check(){
        $user = $this->getUser(session("hr_id"));
        $role = $user->role;

        if($role == "company"){
            return redirect("/employer-dashboard");   
        }else{
            return redirect("/candidate-dashboard"); 
        }
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
            return redirect("/account-check");      
        }

        return back()->with("msg", "Password or Email is not correct!");     
    }

    function generateRandomKey($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomKey = '';
        for ($i = 0; $i < $length; $i++) {
            $randomKey .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomKey;
    }

    public function registerUser(User $user, Request $request){
        request()->validate([
            "email" => "required|email|unique:users",
            "password" => "required|min:5|max:20",
        ]);


        $role = request()->query("role") ?? "candidate";
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->username = request()->username;
        $user->email = request()->email;
        $user->password = request()->password;
        $user->company_name = request()->company_name;
        $user->company_type = request()->company_type;
        $user->unique_id = $this->generateRandomKey();
        $user->phone = request()->phone;
        $user->role = $role;
        $user->save();

        if($user){
            session()->put("hr_id", $user->id);
            // $this->sendMail($request, $user->id);
            return redirect("/account-check");   
        }
        
        return back()->with("msg", "something went wrong");
    }

    public function getUser($id){        
        $user = User::find($id);
        return $user;
    }
 
    public function searchUser($page_name){  
        $query = request()->search;   
        $location = request()->location;
        if($location){            
            $user = User::where("username", "like", "%$query%")
            ->orWhere("first_name", "like", "%$query%")
            ->orWhere("last_name", "like", "%$query%")
            ->orWhere("country", "like", "%$location%")
            ->orWhere("state", "like", "%$location%")
            ->orWhere("title", "like", "%$query%")
            // ->orWhere("role", "=", "%$page_name%")
            ->get();
        }else{
            $user = User::where("username", "like", "%$query%")
            ->orWhere("first_name", "like", "%$query%")
            ->orWhere("last_name", "like", "%$query%")
            ->orWhere("country", "like", "%$query%")
            ->orWhere("state", "like", "%$query%")
            ->orWhere("title", "like", "%$query%")
            // ->orWhere("role", "=", "%$page_name%")
            ->get();
        }

        // dd($user);

        $data["users"] = $user;
        $data["isSearch"] = true;
        return view("pages.$page_name", compact("data"));
    }
  
 
    public function logOut(){
         session()->pull("hr_id");
         return redirect("/login");
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
        $user->address = $request->address ?? $user->address;
        $user->phone = $request->phone ?? $user->phone;
        $user->company_name = $request->company_name ?? $user->company_name;
        $user->company_branch = $request->company_branch ?? $user->company_branch;
        $user->salary = $request->salary ?? $user->salary;
        $user->title = $request->title ?? $user->title;
        $user->education = $request->education ?? $user->education;
        $user->is_verified = $request->is_verified ?? $user->is_verified;
        $user->company_type = $request->company_type ?? $user->company_type;
        $user->role = $request->role ?? $user->role;
        $user->cv = $request->cv ?? $user->cv;
        $user->experience = $request->experience ?? $user->experience;
        $user->skills = $request->skills ?? $user->skills;
        if($request->company_logo){
            $photo = $this->uploadImage();
            $user->avatar = $photo;
        }

        $user->update();        
        return back()->with("msg", "Profile updated successfully");
    }

    public function uploadImage(){    
        $file = request()->file('company_logo')->getRealPath();   
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

    public function newRoleAll($role){  
        $user = User::where('role', $role)->inRandomOrder()->paginate(12);
        return $user;
    }

    public function newCandAll($role){  
        $user = User::where('role', $role)->inRandomOrder()->paginate(9);
        return $user;
    }


    public function candidateAll(){
        $data["users"] = $this->newCandAll("candidate");
        return view("pages.candidate", compact("data"));
    }

    public function candidateSingle($unique_id){
        $data["user"] = $this->getUserByCompany($unique_id);
        return view("pages.single_candidate", compact("data"));;
    }

    public function employersAll(){
        $data["users"] = $this->newRoleAll("company");
        return view("pages.employers", compact("data"));
    }

    public function getUserByCompany($unique_id){  
        $user = User::where('unique_id', $unique_id)->first();
        return $user;
    }

    //jobs

    public function createJob(Job $job, Request $request){
        $salary = request()->salary;
        $salary = str_replace("$ ", "", $salary);
        $salary = str_replace(",", "", $salary);
        $job->title = request()->job_title;
        $job->skills = request()->skills;
        $job->employment_type = request()->employment_type;
        $job->level = request()->level;
        $job->description = request()->description;
        $job->company_id =  session("hr_id") ?? 0;
        $job->email = request()->email;
        $job->experience = request()->experience;
        $job->salary = $salary;
        $job->job_type = request()->job_type;
        $job->phone = request()->phone;
        $job->location = request()->location;
        $job->state = request()->state;
        $job->city = request()->city;
        $job->country = request()->country;
        $job->address = request()->address;

        if($request->company_logo){
            $photo = $this->uploadImage();
            $job->avatar = $photo;
        }

        $job->save();

        if($job){
            return back()->with("msg", "Job was posted successfully");   
        }
        
        return back()->with("msg", "something went wrong");
    }

    public function getJobs(){  
        $job = Job::inRandomOrder()->paginate(12);
        return $job;
    }

    public function job_single($job_title, $id){
        $data["job"] = Job::find($id);
        $data["title"] = str_replace("_", " ", $job_title);
        $data["company"] = User::find($data["job"]->company_id);
        
        if(!$data["job"]){
            return redirect("/");
        }

        if(!$data["company"]){
            return redirect("/");
        }

        return view("pages.job_single", compact("data"));
    }

    public function employersSingle($unique_id){
        $data["user"] = $this->getUserByCompany($unique_id);
        if(!$data["user"]){
            return back();
        }
        return view("pages.single_employer", compact("data"));;
    }

    public function browse_job(){
        $data["jobs"] = $this->getJobs();
        return view("pages.jobs", compact("data"));;
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
