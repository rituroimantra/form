<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\EmploymentExchange;
use App\Models\Nationality;
use App\Models\Caste;
use App\Models\ApplicationForm;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    
    {
        $userId = Auth::id();
        if (ApplicationForm::where('user_id', $userId)->exists()) {
            // If the user ID exists, redirect to another page
            return redirect()->route('basic.details');
        }
        $posts = Post::pluck('name', 'id');
        $employementExchange = EmploymentExchange::pluck('state_name', 'id');
        $nationality = Nationality::pluck('name', 'id');
        $caste = Caste::pluck('name', 'id');
        return view('home',compact('posts','employementExchange','nationality','caste'));
    }
    public function getDisabilityTypes()
    {
        try {
            $postId = request()->input('postId');
            $post = Post::findOrFail($postId);
            $disabilityTypes = $post->disabilityTypes()->pluck('name', 'id');
            return response()->json($disabilityTypes);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
      
    }
    public function submitFormOne(Request $request)
    {
        
        $existingUser = ApplicationForm::where('email', $request->email)->first();
        if ($existingUser) {
            // User already exists, handle accordingly
            return redirect()->back()->with('error', 'User already exists!');
        }
        $request->validate([
            'post' => 'required',
            'wcl' => 'required', 
             'duration_oil' => $request->input('wcl') == 'yes' ? 'required' : '',
             'key_no' => $request->input('wcl') == 'yes' ? 'required' : '',
             'employment_exchange' => $request->input('wcl') == 'no' ? 'required' : '',
             'employment_exchange_no' => $request->input('wcl') == 'no' ? 'required' : '',
             'name'=>'required',
             'email' => 'required',
             'mobile'=>'required',
             'gender'=>'required',
             'nationality'=>'required',
             'disabilities' => 'required',
             'percentage_Of_isability' => $request->input('disabilities') == 'Yes' ? 'required' : 'nullable',
             'disability_types' => $request->input('disabilities') == 'Yes' ? 'required|array|min:1' : 'nullable|array|min:1',
             'disability_certificate_no'=>$request->input('disabilities') == 'Yes' ? 'required' : '',
             'disability_certificate_date'=>$request->input('disabilities') == 'Yes' ? 'required' : '',
             'caste'=>'required',
             'caste_certificate_no'=>$request->input('caste') == '2' || $request->input('caste') == '3' || $request->input('caste') == '4' ? 'required' : '',
             'caste_certificate_date'=>$request->input('caste') == '2' || $request->input('caste') == '3' || $request->input('caste') == '4' ? 'required' : '',
             'non_creamy_layer'=>$request->input('caste') == '2' ? 'required' : '',
             'non_creamy_layer_certificate_no'=>$request->input('non_creamy_layer') == 'Yes' ? 'required' : '',
             'non_creamy_layer_certificate_date'=>$request->input('non_creamy_layer') == 'Yes' ? 'required' : '',
             'ex_servicemen'=>'required',
             'ex_servicemen_certificate_no'=>$request->input('ex_servicemen') == 'Yes' ? 'required' : '',
             'ex_servicemen_certificate_date'=>$request->input('ex_servicemen') == 'Yes' ? 'required' : '',
             'ex_servicemen_certificate_period'=>$request->input('ex_servicemen') == 'Yes' ? 'required' : '',
             'date_of_birth'=>'required',
             'year'=>'required',
             'month'=>'required',
             'day'=>'required',
        ]);
        $dateOfBirth = $request->year . '-' . $request->month . '-' . $request->day;
        $candidate_age=$dateOfBirth;
        $applicationForm = new ApplicationForm();
        $applicationForm->user_id =Auth::user()->id;
        $applicationForm->post = $request->post;
        $applicationForm->wcl = $request->wcl;
        $applicationForm->duration_oil = $request->duration_oil;
        $applicationForm->key_no = $request->key_no;
        $applicationForm->employment_exchange = $request->employment_exchange;
        $applicationForm->employment_exchange_no = $request->employment_exchange_no;
        $applicationForm->name = $request->name;
        $applicationForm->email = $request->email;
        $applicationForm->mobile = $request->mobile;
        $applicationForm->alternate_mobile = $request->alternatemobile;
        $applicationForm->gender = $request->gender;
        $applicationForm->nationality = $request->nationality;
        $applicationForm->disability = $request->disabilities;
        $applicationForm->percentage_Of_disability = $request->percentage_Of_isability;
        $applicationForm->type_Of_disability = json_encode($request->disability_types);
        $applicationForm->disability_certificate = $request->disability_certificate_no;
        $applicationForm->disability_date = $request->disability_certificate_date;
        $applicationForm->caste = $request->caste;
        $applicationForm->caste_certificate = $request->caste_certificate_no;
        $applicationForm->caste_date = $request->caste_certificate_date;
        $applicationForm->non_creamy = $request->non_creamy_layer;
        $applicationForm->non_creamy_certificate = $request->non_creamy_layer_certificate_no;
        $applicationForm->non_creamy_date = $request->non_creamy_layer_certificate_date;
        $applicationForm->ex_servicemen = $request->ex_servicemen;
        $applicationForm->ex_servicemen_certificate = $request->ex_servicemen_certificate_no;
        $applicationForm->ex_servicemen_date = $request->ex_servicemen_certificate_date;
        $applicationForm->ex_servicemen_period = $request->ex_servicemen_certificate_period;
        $applicationForm->date_of_birth = $request->date_of_birth;
        $applicationForm->candidate_age = $candidate_age;
        // Set other fields accordingly

        $applicationForm->save();

        // Redirect or perform any other action after successful submission
        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
