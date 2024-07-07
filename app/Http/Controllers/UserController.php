<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\PdfToText\Pdf;
use App\Services\GoogleGeminiService;

class UserController extends Controller
{

    protected $pdf;
    protected $googleGeminiService;

    public function __construct(GoogleGeminiService $googleGeminiService, Pdf $pdf)
    {
        $this->googleGeminiService = $googleGeminiService;
        $this->pdf = $pdf;
    }

    public function candidateDash(){
        $data["applications"] = Application::where(["userId" => session("hr_id")])->get();
        $data["user"] = $this->getUser(session("hr_id"));
        return view("dashboard.candidate_dash", compact("data"));
    }

    public function employersDash(){
        $data["applications"] = Application::where(["company_id" => session("hr_id")])->get();
        $data["user"] = $this->getUser(session("hr_id"));
        $data["jobs"] = $this->getEmployerJob(session("hr_id"));
        $data["approved_job"] = Job::where(["company_id" => session("hr_id"), "status" => "approve"])->get();
        $data["pending_job"] = Job::where(["company_id" => session("hr_id"), "status" => "pending"])->get();
        $data["decline_job"] = Job::where(["company_id" => session("hr_id"), "status" => "decline"])->get();
        return view("dashboard.employers_dash", compact("data"));
    }

    public function getEmployerJob($id){        
        $jobs = Job::where("company_id", $id)->get();
        return $jobs;
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

    public function createApplication(Application $application){  
        if(!session("hr_id")){
            return back()->with("Erromsg", "You cannot perform this operation, Account login is require to apply for this job");
        }

        $user = $this->getUser(session("hr_id"));
        if($user->role != "candidate"){
            return back()->with("Erromsg", "You cannot perform this operation, a company account cannot apply for a job");
        }
        
        $find = $application::where(["company_id" => session("hr_id"), "job_id" => request()->job_id  ])->get();
        if(count($find) != 0){
            return back()->with("Erromsg", "You cannot perform this operation, you've applied for this job already");
        }


        $application->company_id =  request()->company_id ?? 0;
        $application->user_id =  $user->unique_id ?? 0;
        $application->userId =  session("hr_id") ?? 0;
        $application->job_id =  request()->job_id ?? 0;
        $application->user_email = request()->email;
        $application->phone = request()->phone;
        $application->username = request()->name;
        $application->user_state = request()->state;
        $application->user_education = request()->education;
        $application->user_portfolio = request()->website;
        $application->user_city = request()->city;
        $application->user_country = request()->country;
        $application->avatar = $user->avatar;
        $application->job_title = request()->job_title;

        $file = request()->file('company_logo')->getRealPath(); 
        $pdfText = $this->pdf->getText($file);
        $questions = $this->chatGemini(request()->job_title);
        $formatted = explode("\n", $questions);

        if(request()->company_logo){
            $photo = $this->uploadPDF();
            $application->user_resume = $photo;
        }

        $save = true ;// $application->save();
        if($save){
            $title = str_replace(" ", "_", request()->job_title);
            $job_id = request()->job_id ;
            return redirect("/automated-questions/$title/$job_id");
            // return back()->with("msg", "Application is sent successfully");
        }
        return back()->with("Erromsg", "Something went wrong");

    }

    public function uploadPDF(){    
        $file = request()->file('company_logo')->getRealPath();   
        $cloudinary = new Cloudinary();    
        $uploadedFileUrl = $cloudinary->uploadApi()->upload($file, [
            'resource_type' => 'raw'
        ]);
        
        return $uploadedFileUrl["url"];
    }

    public function chatGemini($userMessage)
    {
        $messages = [
            ["parts" => [
                ["text" => "You are to ask generate atleast 20 advance and very hard questions, don't provide title, just the numbered questions"]
            ], "role" => "model"],
            ["parts" => [
                ["text" => $userMessage]
            ], "role" => "user"],
        ];

        $result = $this->googleGeminiService->generateChatResponse($messages);

        $text = $result["candidates"][0]["content"]["parts"][0]["text"];
        $text = str_replace("*", "", $text);
        return $text;
    }

    public function automated_questions($title, $id){
        // dd($this->chatGeminiAnwers("question 1+1, answer 1, question 2+2, answer 4"));
        $data["job"] = Job::find($id);
        $questions = $this->chatGemini($data["job"]->title);
        $data["questions"] = explode("\n", $questions);
        $data["company"] = User::find($data["job"]->company_id);
        if(count($data["questions"]) == 0){
            return back()->with("Errormsg", "Something went wrong, Please try again later");
        }
        
        return view("pages.automated_questions", compact("data"));
    }

    public function chatGeminiAnwers($userMessage)
    {
        $messages = [
            ["parts" => [
                ["text" => "You are to rate the answers to the questions, 1/100 for overall answers, don't provide rating for a single answer instead calculate all and provide, with ratin description bad, fair, good or excellent and improvement suggestion"]
            ], "role" => "model"],
            ["parts" => [
                ["text" => $userMessage]
            ], "role" => "user"],
        ];

        $result = $this->googleGeminiService->generateChatResponse($messages);

        $text = $result["candidates"][0]["content"]["parts"][0]["text"];
        $text = str_replace("*", "", $text);
        return $text;
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
