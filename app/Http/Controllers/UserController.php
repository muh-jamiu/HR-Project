<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Education;
use App\Models\Job;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\PdfToText\Pdf;
use App\Services\GoogleGeminiService;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Transfer;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use function imagecreatetruecolor;
use function imagecolorallocate;
use function imagefilledrectangle;
use function imagestring;
use function imagepng;
use function imagedestroy;
use PayPal\Auth\OAuthTokenCredential;
use Exception;

class UserController extends Controller
{

    protected $pdf;
    protected $googleGeminiService;
    private $apiContext;

    public function __construct(GoogleGeminiService $googleGeminiService, Pdf $pdf)
    {
        $this->googleGeminiService = $googleGeminiService;
        $this->pdf = $pdf;
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_SECRET')
            )
        );
        $this->apiContext->setConfig([
            'mode' => 'sandbox',
        ]);
    }

    public function index(){ 
        $data["rand_jobs"] = Job::inRandomOrder()->paginate(12);
        $data["jobs"] = $this->getJobsLatest();    
        return view("index", compact("data"));
    }

    public function admin_login(){
        return view("dashboard.admin_login");
    }


    public function admin(){ 
        $user = $this->getUser(session("hr_id"));
        $role = $user ? $user->role : null;

        if($role != "admin"){
            return back()->with("msg", "Unauthorized");
        }

        $data["chart"] = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $data["chartjob"] = Job::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $data["chartapps"] = Application::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $data["employer"] = User::where("role", "company")->get();
        $data["candidate"] = User::where("role", "candidate")->get();
        $data["applications"] = Application::all();
        $data["jobs"] = Job::all();
        $data["user"] = $this->getUser(session("hr_id"));
        // dd($data["chart"]);

        return view("dashboard.admin", compact("data"));
    }

    public function deleteUser($id){
        $user =  User::find($id);
        $user->delete();

        return back()->with("msg", "User was deleted successfully");
    }

    public function deleteJob($id){
        $job =  Job::find($id);
        $job->delete();

        return back()->with("msg", "Job was deleted successfully");
    }

    public function deleteApplc($id){
        $job =  Application::find($id);
        $job->delete();

        return back()->with("msg", "Application was deleted successfully");
    }

    public function candidateDash(){
        $data["education"] = $this->getEducation();
        $data["work"] = $this->getWork();
        $data["applications"] = Application::where(["userId" => session("hr_id")])->get();
        $data["user"] = $this->getUser(session("hr_id"));
        return view("dashboard.candidate_dash", compact("data"));
    }

    public function employersDash(){
        $data["branch"] = $this->getBranches();
        $data["applications"] = Application::where(["company_id" => session("hr_id")])->orderBy("created_at", "desc")->get();
        $data["user"] = $this->getUser(session("hr_id"));
        $data["jobs"] = $this->getEmployerJob(session("hr_id"));
        $data["approved_job"] = Job::where(["company_id" => session("hr_id"), "status" => "approve"])->orderBy("created_at", "desc")->get();
        $data["pending_job"] = Job::where(["company_id" => session("hr_id"), "status" => "pending"])->orderBy("created_at", "desc")->get();
        $data["decline_job"] = Job::where(["company_id" => session("hr_id"), "status" => "decline"])->orderBy("created_at", "desc")->get();
        return view("dashboard.employers_dash", compact("data"));
    }

    public function getEmployerJob($id){        
        $jobs = Job::where("company_id", $id)->orderBy("created_at", "desc")->get();
        return $jobs;
    }

    public function check(){
        $user = $this->getUser(session("hr_id"));
        $role = $user->role;

        if($role == "company"){
            return redirect("/employer-dashboard");   
        }else if($role == "admin"){
            return redirect("/admin-panel"); 
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


        $role = request()->first_name ? "candidate" : "employer";
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

    public function searchJob(){  
        $query = request()->search;   
        $location = request()->location;
        if($location){            
            $job = Job::where("title", "like", "%$query%")
            ->orWhere("description", "like", "%$query%")
            ->orWhere("experience", "like", "%$query%")
            ->orWhere("job_type", "like", "%$query%")
            ->orWhere("location", "like", "%$location%")
            ->paginate(12);
        }else{
            $job = Job::where("title", "like", "%$query%")
            ->orWhere("description", "like", "%$query%")
            ->orWhere("experience", "like", "%$query%")
            ->orWhere("job_type", "like", "%$query%")
            ->paginate(12);
        }

        $data["jobs"] = $job;
        $data["isSearch"] = true;
        return view("pages.jobs", compact("data"));
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
        return back()->with("msg", "Profile was updated successfully!");
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

    // public function generateImage()
    // {
    //     // Create an image canvas
    //     $width = 400;
    //     $height = 200;
    //     $image = imagecreatetruecolor($width, $height);

    //     // Allocate colors
    //     $bgColor = imagecolorallocate($image, 240, 240, 240);
    //     $textColor = imagecolorallocate($image, 0, 0, 0);

    //     // Fill the background
    //     imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

    //     // Set the text to draw
    //     $text = 'Hello, Laravel!';
    //     $font = 5; // Built-in font sizes are 1-5
    //     $x = 50;
    //     $y = 80;

    //     // Add the text to the image
    //     imagestring($image, $font, $x, $y, $text, $textColor);

    //     // Create the image response
    //     ob_start();
    //     imagepng($image);
    //     $imageData = ob_get_contents();
    //     ob_end_clean();

    //     // Free up memory
    //     imagedestroy($image);

    //     return $imageData;

    //     // return Response::make($imageData, 200, ['Content-Type' => 'image/png']);
    // }

    public function candidateSingle($unique_id){
        $data["user"] = $this->getUserByCompany($unique_id);
        $data["work"] = $this->getCandWork($data["user"]->id);
        $data["education"] = $this->getCandEducation($data["user"]->id);
        return view("pages.single_candidate", compact("data"));;
    }

    public function getCandEducation($id){
        $education = Education::where("user_id", $id)->orderBy("created_at", "desc")->get();
        return $education;
    }

    public function getCandWork($id){
        $work = Work::where("user_id", $id)->orderBy("created_at", "desc")->get();
        return $work;
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
        $data["user"] = $this->getUser(session("hr_id")) ?? null;

        if(!$data["job"]){
            return redirect("/");
        }

        if(!$data["company"]){
            return redirect("/");
        }

        return view("pages.job_single", compact("data"));
    }

    public function application_single($job_title, $id){
        $data["application"] = Application::find($id);
        $data["job"] = Job::find($data["application"]->job_id);
        $data["title"] = str_replace("_", " ", $data["application"]->job_title);
        $data["company"] = User::find($data["job"]->company_id);
        $data["user"] = $this->getUser(session("hr_id")) ?? null;
        $data["applied_user"] = $this->getUser($data["application"]->userId) ?? null;

        if(!$data["job"]){
            return redirect("/");
        }

        if(!$data["company"]){
            return redirect("/");
        }

        return view("pages.application_single", compact("data"));        
    }

    public function employersSingle($unique_id){
        $data["user"] = $this->getUserByCompany($unique_id);
        if(!$data["user"]){
            return back();
        }

        $data["branch"] = $this->getBranchforComp( $data["user"]->id);
        return view("pages.single_employer", compact("data"));;
    }

    public function getBranchforComp($id){
        $branch = Branch::where("company_id", $id)->get();
        return $branch;
    }


    public function getJobsLatest(){  
        $job = Job::orderBy("created_at", "desc")->paginate(6);
        return $job;
    }

    public function browse_job(){
        $data["jobs"] = $this->getJobs();
        return view("pages.jobs", compact("data"));;
    }

    public function myJobs(){  
        $job = Job::where("company_id", session("hr_id"))->orderBy("created_at", "desc")->paginate(12);
        return $job;
    }

    public function my_job(){
        if(!session("hr_id")){
            return redirect("/");
        }
        
        $data["jobs"] = $this->myJobs();
        return view("pages.myjobs", compact("data"));;
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
        $formatted = explode("\n", $pdfText);
        if($formatted == ""){
            return back()->with("Erromsg", "Something went wrong, your resume can't be read, Please provide a valid resume.");
        }
        
        if(request()->company_logo){
            $photo = $this->uploadPDF();
            $application->user_resume = $photo;
        }
        
        $save = $application->save();
        if(!$save){
            return back()->with("Erromsg", "Something went wrong, Please try again.");
        }

        $questions = $this->chatGemini(json_encode($formatted));
        if($questions){
            session()->put("job_id", $application->id);
            $data["job"] = Job::find(request()->job_id);
            $data["company"] = User::find($data["job"]->company_id);
            $data["questions"] = explode("\n", $questions);
            return view("pages.automated_questions", compact("data"));
        }

        return back()->with("Erromsg", "Something went wrong, Please try again.");

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

    // public function automated_questions($title, $id){
    //     $data["job"] = Job::find($id);
    //     $questions = $this->chatGemini($data["job"]->title);
    //     $data["questions"] = explode("\n", $questions);
    //     $data["company"] = User::find($data["job"]->company_id);
    //     if(count($data["questions"]) == 0){
    //         return back()->with("Errormsg", "Something went wrong, Please try again later");
    //     }
        
    //     return view("pages.automated_questions", compact("data"));
    // }

    public function post_automated_questions(){
        $job_id = session("job_id");
        $request = request()->all();
        unset($request['_token']);
        $requestString = json_encode($request);
        $rating = $this->chatGeminiAnwers($requestString);
        $job = Application::find($job_id);
        $job->automated_q = $rating;
        $job->update();  
        $job_title = str_replace(" ", "_", $job->job_title);
        $job_id = $job->job_id;
        return redirect("/technical-questions/$job_title/$job_id");
    }

    public function chatGeminiAnwers($userMessage)
    {
        $messages = [
            ["parts" => [
                ["text" => "You are to rate the answers to the questions and provide details for the employer base on the question answered by the candidate, 1/100 for overall answers, don't provide rating for a single answer instead calculate all and provide, with rating description bad, fair, good or excellent and improvement suggestion"]
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

    public function technical_questions($title, $id){
        $data["job"] = Job::find($id);
        $questions = $this->technicalGemini($data["job"]->title);
        $data["questions"] = explode("\n", $questions);
        $data["company"] = User::find($data["job"]->company_id);
        if(count($data["questions"]) == 0){
            return back()->with("Errormsg", "Something went wrong, Please try again later");
        }
        
        return view("pages.technical_questions", compact("data"));
    }

    public function post_technical_questions(){
        $job_id = session("job_id");
        $request = request()->all();
        unset($request['_token']);
        $requestString = json_encode($request);
        $rating = $this->chatGeminiAnwers($requestString);
        $job = Application::find($job_id);
        $job->technical_q = $rating;
        $job->update();  
        $job_title = str_replace(" ", "_", $job->job_title);
        $job_id = $job->job_id;
        return redirect("/skills-questions/$job_title/$job_id");
    }
    
    public function technicalGemini($userMessage)
    {
        $messages = [
            ["parts" => [
                ["text" => "You are to ask generate atleast 20 technical advance and very hard questions, don't provide title, just the numbered questions"]
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

    public function communicationGemini($userMessage)
    {
        $messages = [
            ["parts" => [
                ["text" => "You are to ask generate atleast 20 questions base on the user communication and team work, don't provide title, just the numbered questions"]
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

    public function skills_questions($title, $id){
        $user = $this->getUser(session("hr_id"));
        $questions = $this->communicationGemini("hi");

        $data["job"] = Job::find($id);
        $data["questions"] = explode("\n", $questions);
        $data["company"] = User::find($data["job"]->company_id);
        return view("pages.skills_questions", compact("data"));
    }


    // public function skills_questions($title, $id){
    //     $user = $this->getUser(session("hr_id"));
        
    //     if($user->bio){
    //         $questions = $this->technicalGemini($user->bio);
    //     }

    //     if($user->skills){
    //         $questions = $this->technicalGemini($user->skills);
    //     }

    //     $data["job"] = Job::find($id);
    //     $data["questions"] = explode("\n", $questions);
    //     $data["company"] = User::find($data["job"]->company_id);
    //     return view("pages.skills_questions", compact("data"));
    // }

    public function post_skills_questions(){
        $job_id = session("job_id");
        $request = request()->all();
        unset($request['_token']);
        $requestString = json_encode($request);
        $rating = $this->chatGeminiAnwers($requestString);
        $job = Application::find($job_id);
        $job->skill_q = $rating;
        $job->update();
        $job_title = str_replace(" ", "_", $job->job_title);
        $job_id = $job->job_id;
        return redirect("/candidate-dashboard");
    }

    public function skillsGemini($userMessage)
    {
        $messages = [
            ["parts" => [
                ["text" => "You are to ask generate atleast 20 question base on the user bio and skils"]
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

    public function pay_with_stripe(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe_succss'),
            'cancel_url' => route('stripe_fail'),
        ]);

        return response()->json(['id' => $session->id]);
    }

    function stripe_success(){
        dd("stripe_success");
    }

    
    function stripe_fail(){
        dd("stripe_fail");
    }

    public function stripeTransfer(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $transfer = Transfer::create([
                'amount' => $request->amount ?? 100000,
                'currency' => 'usd',
                'destination' => $request->destination_account ?? 102938839,
                'transfer_group' => 'ORDER_95',
            ]);

            return 'Transfer successful!';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function createPaypalTransaction(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal('20.00');
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('T-shirt');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('stripe_succss'))
            ->setCancelUrl(route('stripe_succss'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            dd($this->apiContext);
            $payment->create($this->apiContext);
            dd($payment);
            return redirect($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            dd($ex);
        }
        catch (Exception $ex) {
            dd($$ex);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function createBranch(Branch $branch){
        $branch->company_id =  session("hr_id") ?? 0;
        $branch->name =  request()->branch_name ?? 0;
        $branch->country =  request()->branch_country ?? 0;
        $branch->state =  request()->branch_state ?? 0;
        $branch->date =  request()->branch_date ?? 0;
        $branch->save();

        return back()->with("msg", "Branch was added successfully");
    }

    public function getBranches(){
        $branch = Branch::where("company_id", session("hr_id"))->orderBy("created_at", "desc")->get();
        return $branch;
    }

    public function deleteBranch(){
        $branch = Branch::find(request()->id);
        $branch->delete();
        return back()->with("msg", "Branch was deleted successfully");
    }

    public function createEducation(Education $education){
        $education->user_id =  session("hr_id") ?? 0;
        $education->name =  request()->name ?? 0;
        $education->degree =  request()->degree ?? 0;
        $education->date =  request()->date ?? 0;
        $education->save();

        return back()->with("msg", "Education was added successfully");
    }

    public function getEducation(){
        $education = Education::where("user_id", session("hr_id"))->orderBy("created_at", "desc")->get();
        return $education;
    }

    public function createWork(Work $work){
        $work->user_id =  session("hr_id") ?? 0;
        $work->title =  request()->work_name ?? 0;
        $work->country =  request()->work_country ?? 0;
        $work->state =  request()->work_state ?? 0;
        $work->date =  request()->work_date ?? 0;
        $work->save();

        return back()->with("msg", "Work Experience was added successfully");
    }

    public function getWork(){
        $work = Work::where("user_id", session("hr_id"))->orderBy("created_at", "desc")->get();
        return $work;
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
