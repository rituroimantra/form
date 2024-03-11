<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\ExperienceForm;
use Illuminate\Support\Facades\Validator;
use DateTime;
use DB;
class ExperienceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ExperienceDetails()
    
    {
        $userId = Auth::id();
       
        return view('form.experience');
        
    }
    public function GetExperienceDetails()
    {
        $userId = Auth::id();
        $experiences = Experience::select(['id','organization', 'job_description', 'joining_date', 'leaving_date','years','months','days', 'certificate'])->get();
        return response()->json($experiences);
    }
    public function ExperienceDetailsSubmit(Request $request)
{
    $validator = Validator::make($request->all(), [
        'organization' => 'required|string|max:255',
        'jobDescription' => 'required|string',
        'joiningDate' => 'required|date',
        'leavingDate' => 'nullable|date',
        'certificate' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->all()], 422);
    }

    $file = $request->file('certificate');
    $fileName = 'experience_document_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    $filePath =  $file->move(public_path('uploads/education'), $fileName);
    $start_date = new DateTime($request->input('joiningDate'));
    $leave_date = new DateTime($request->input('leavingDate'));
    $interval = $start_date->diff($leave_date);
    $total_years = $interval->y;
    $total_months = $interval->m;
    $total_days = $interval->d;
    
    $experience = new Experience();
    $experience->user_id = Auth::user()->id;
    $experience->organization = $request->input('organization');
    $experience->job_description = $request->input('jobDescription');
    $experience->joining_date = $request->input('joiningDate');
    $experience->leaving_date = $request->input('leavingDate');
    $experience->years = $total_years;
    $experience->months = $total_months;
    $experience->days = $total_days;
    $experience->certificate ='uploads/education/'.$fileName;

    
    
    
   



    if($request->has('expeid')) {
        $experience->where('id', $request->input('expeid'))->update($experience->toArray());
    } else {
        $experience->save();
    }

    return response()->json(['success' => true]);
}

    public function GetExperienceDetailsDelete($id){
        try {
            // Find the experience detail by its ID
            $experienceDetail = Experience::findOrFail($id);

            // Delete the experience detail
            $experienceDetail->delete();

            return response()->json(['success' => true, 'message' => 'Experience detail deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete experience detail', 'error' => $e->getMessage()], 500);
        }
    }
    public function GetExperienceDetailsGet($id) {
        try {
            // Find the experience detail by its ID
            $experienceDetail = Experience::findOrFail($id);
    
            return response()->json(['success' => true, 'data' => $experienceDetail]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to retrieve experience detail', 'error' => $e->getMessage()], 500);
        }
    }
    public function ExperienceSubmit(Request $request)
{
    // Validate the form data
    
    $request->validate([
        'employee' => 'required',
        'totalExperience' => $request->input('employee') == 'yes' ? 'required' : '',
    ]);
    // dd($request->all());
    try {
           $experienceForm = new ExperienceForm();
           
           $experienceForm->user_id = Auth::user()->id;
           $experienceForm->value_stored = $request->input('employee');
           $experienceForm->total_experience = $request->input('totalExperience');
          

           $data = DB::table('experience_forms')
           ->where('user_id', Auth::user()->id)
           ->first();
        
           if($data) {
            $experienceForm->where('user_id', Auth::user()->id)->update($experienceForm->toArray());
        } else {
            $experienceForm->save();
        }
        

        // Redirect the user after successful form submission
        return redirect()->back()->with('success', 'Qualifications added successfully.');
    } catch (\Exception $e) {
        // If an exception occurs, handle it appropriately
        return redirect()->back()->with('error', 'An error occurred while adding qualifications. Please try again.');
    }
}
}