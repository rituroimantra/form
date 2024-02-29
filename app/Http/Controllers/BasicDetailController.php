<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasicDetail;
use Illuminate\Support\Facades\Auth;

class BasicDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function BasicDetails()
    
    {
        $userId = Auth::id();
        if (BasicDetail::where('user_id', $userId)->exists()) {
            // If the user ID exists, redirect to another page
            return redirect()->route('educational.qualifications');
        }
        return view('form.basicdetails');
    }
    public function BasicDetailsSubmit(Request $request)
{
    // Validate form data
    $validatedData = $request->validate([
        'father' => 'required',
        'marital_status' =>'required',
        'permanent_pin_code'=>'required',
        'permanent_city'=>'required',
        'permanent_state'=>'required',
        'permanent_address_one'=>'required',
        'correspondence_pin_code'=>'required',
        'correspondence_city'=>'required',
        'correspondence_state'=>'required',
        'correspondence_address_one'=>'required',
        // Add validation rules for other fields as needed
    ]);

    // Create a new ApplicationForm instance
    $applicationForm = new BasicDetail();
    $applicationForm->user_id =Auth::user()->id;
    $applicationForm->father = $request->father;
    $applicationForm->mother = $request->mother;
    $applicationForm->marital_status = $request->marital_status;
    $applicationForm->permanent_pin_code = $request->permanent_pin_code;
    $applicationForm->permanent_city = $request->permanent_city;
    $applicationForm->permanent_state = $request->permanent_state;
    $applicationForm->permanent_address_one = $request->permanent_address_one;
    $applicationForm->permanent_address_two = $request->permanent_address_two;
    $applicationForm->correspondence_pin_code = $request->correspondence_pin_code;
    $applicationForm->correspondence_city = $request->correspondence_city;
    $applicationForm->correspondence_state = $request->correspondence_state;
    $applicationForm->correspondence_address_one = $request->correspondence_address_one;
    $applicationForm->correspondence_address_two = $request->correspondence_address_two;

    // Save the application form data
    $applicationForm->save();

    // Optionally, redirect to a success page
    return redirect()->back()->with('success', 'Application submitted successfully!');
}
}