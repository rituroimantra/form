<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Experience;
use Illuminate\Support\Facades\Validator;
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
        $experiences = Experience::select(['id','organization', 'job_description', 'joining_date', 'leaving_date', 'certificate'])->get();
        return response()->json($experiences);
    }
    public function ExperienceDetailsSubmit(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'organization' => 'required|string|max:255',
            'jobDescription' => 'required|string',
            'joiningDate' => 'required|date',
            'leavingDate' => 'nullable|date',
            'certificate' => 'required|file|mimes:pdf,doc,docx|max:2048', // Adjust the file size limit as needed
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
    
        // Store the file in a folder (e.g., 'certificates') within the 'storage/app' directory
        
        $file = $request->file('certificate');
        $fileName = 'experience_document_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath =  $file->move(public_path('uploads/education'), $fileName);
        // Create a new Experience instance and fill it with the validated data
        $experience = new Experience();
        $experience->user_id = Auth::user()->id;
        $experience->organization = $request->input('organization');
        $experience->job_description = $request->input('jobDescription');
        $experience->joining_date = $request->input('joiningDate');
        $experience->leaving_date = $request->input('leavingDate');
        $experience->certificate ='uploads/education/'.$fileName; // Save the path to the uploaded certificate file
        $experience->save();
    
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
}
