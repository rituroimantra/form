<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BasicDetail;
use App\Models\Qualification;
use App\Models\Post;
use App\Models\DropdownOption;
use App\Models\ApplicationForm;
use DataTables;
use App\Models\UserQualification;
use Illuminate\Support\Facades\Storage;

class EducationQualificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function EducationalQualifications()
    
    {
        $userId = Auth::id();
        if (UserQualification::where('user_id', $userId)->exists()) {
            // If the user ID exists, redirect to another page
            return redirect()->route('experience-details');
        }
        return view('form.education');
    }
    public function getQualifications()
    {
        $userId = Auth::id();
        $postId = ApplicationForm::where('user_id', $userId)->first();
        $qualifications = Qualification::where('post_id', $postId->post)->get();
        
        return DataTables::of($qualifications)
        
            ->addColumn('name', function ($qualification) {
                return $qualification->name;
            })
            ->addColumn('input_type', function ($qualification) {
                return $qualification->input_type;
            })
            ->addColumn('option', function ($qualification) {
                if ($qualification->input_type === 'select') {
                    return DropdownOption::where('qualification_id', $qualification->id)->pluck('option');
                } else {
                    return '';
                }
            })
            ->addColumn('board_name', function ($qualification) {
                // Return board name logic here
                return $qualification->board_name;
            })
            ->addColumn('year_of_passing', function ($qualification) {
                // Return year of passing logic here
                return $qualification->year_of_passing;
            })
            ->addColumn('subject', function ($qualification) {
                // Return subject logic here
                return $qualification->subject;
            })
            ->addColumn('percentage', function ($qualification) {
                // Return percentage logic here
                return $qualification->percentage;
            })
            ->addColumn('document', function ($qualification) {
                // Return document logic here
                return $qualification->document;
            })
            ->make(true);
    }
    public function EducationDocumentUpload(Request $request)
{
    // Validate the request data
    $request->validate([
        'file' => 'required|mimes:pdf,doc,docx|max:2048', // Adjust maximum file size as needed
        'qualification_id' => 'required|exists:qualifications,id',
    ]);

    // Process the uploaded file
    $file = $request->file('file');
    $qualificationId = $request->qualification_id;
    $fileName = 'education_document_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    $filePath =  $file->move(public_path('uploads/education'), $fileName);
    // Perform any additional processing, such as saving the file to disk and updating the database
    // $fileUrl = Storage::url($filePath);
    // dd($fileUrl);
    return response()->json(['success' => true,'fileName' =>$fileName]);
}

public function EducationalQualificationSubmit(Request $request)
{
    // Validate the form data
    // dd($request->all());
    $request->validate([
        'qualification_name.*' => 'required|string',
        'board_name' => 'required|array',
        'board_name.*' => 'required|string',
        'year_of_passing' => 'required|array',
        'year_of_passing.*' => 'required|integer',
        'subject' => 'required|array',
        'subject.*' => 'required|string',
        'percentage' => 'required|array',
        'percentage.*' => 'required|numeric',
        'documents.*' => 'required',
    ]);
  
    try {
        // Process each qualification submitted in the form
        foreach ($request->qualification_name as $key => $qualificationName) {
            $qualification = new UserQualification([
                'user_id' => Auth::user()->id,
                'qualification_name' => $request->qualification_name[$key],
                'board_name' => $request->board_name[$key],
                'year_of_passing' => $request->year_of_passing[$key],
                'subject' => $request->subject[$key],
                'percentage' => $request->percentage[$key],
                'document'=> 'uploads/education/'.$request->documents[$key]
            ]);

            $qualification->save();
        }

        // Redirect the user after successful form submission
        return redirect()->back()->with('success', 'Qualifications added successfully.');
    } catch (\Exception $e) {
        // If an exception occurs, handle it appropriately
        return redirect()->back()->with('error', 'An error occurred while adding qualifications. Please try again.');
    }
}
    
}
