
<form method="POST" action="{{ url('/application-form-submit') }}" id="formone">
    @csrf
    <div class="row gray">
        <div class="col-md-5">
            <div class="form-group">
                <label for="post">Post Applied For *</label>
                <select class="form-control" id="post" name="post">
                    <option value="">Select a Post</option>
                    @foreach ($posts as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>WCL of OIL *</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="wcl" id="wcl_yes" value="yes">
                    <label class="form-check-label" for="wcl_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="wcl" id="wcl_no" value="no">
                    <label class="form-check-label" for="wcl_no">No</label>
                </div>

            </div>

        </div>
    </div>
    <div class="row lightgreen">
        <div class="col-md-5">
            <div class="form-group">
                <label for="durationoil">Duration of service rendered through contractor for OIL's contractual job's
                    *</label>
                <input type="number" class="form-control" id="durationoil" name="duration_oil" disabled>

            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="keyno">Key No.</label>
                <input type="text" class="form-control" id="keyno" name="key_no" disabled>
            </div>

        </div>
    </div>
    <div class="row gray">
        <div class="col-md-5">
            <div class="form-group">
                <label for="employmentexchange">Employment Exchange *</label>
                <select class="form-control" id="employmentexchange" name="employment_exchange" disabled>
                    <option value="">Select Employment Exchange</option>
                    @foreach ($employementExchange as $id => $state_name)
                    <option value="{{ $id }}">{{ $state_name }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="employmentexchangeno">Employment Exchange Registration No.*</label>
                <input type="number" class="form-control" id="employmentexchangeno" name="employment_exchange_no"
                    disabled>
            </div>

        </div>
    </div>
    <div class="row box-horizontal">
        <div class="col-md-12">
            <div>
                <span>Personal Details</span>
            </div>
        </div>
    </div>
    <div class="row lightgreen">
        <div class="col-md-5">
            <div class="form-group">
                <label for="name">Name of the Applicant*</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <span class="helpLine">[Note 1: Name as recorded in the Matriculation/Secondary
                Examination Certificate]<br>
                [Note 2: Please do not use any prefix such as Shri/ Mr./ Ms./ Dr./ Mrs. Etc.]
            </span>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="email">Email Address<span class="red">*</span></label>
                <input type="text" class="form-control" id="email" name="email"
                    value="@if (Auth::check()){{ Auth::user()->email }}@else @endif" readOnly>
            </div>
            <span class="helpLine">[Enter your correct e-mail address that is current active. It will also be your
                unique login Id]<br>
                [Note that All the communication from Oil India Limited will be made on this e-mail
                address only.] </span>

        </div>
    </div>
    <div class="row gray">
        <div class="col-md-5">
            <div class="form-group">
                <label for="mobile">Mobile Number<span class="red">*</span></label>
                <input type="text" class="form-control" id="mobile" name="mobile"
                    value="@if (Auth::check()){{ Auth::user()->mobile_number }}@else @endif" readOnly>
            </div>
            <span class="helpLine">[Enter Your Mobile Number without 91 or +91 as 9999988888]</span>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="alternatemobile">Alternate Mobile Number<span class="red">*</span></label>
                <input type="text" class="form-control" id="alternatemobile" name="alternatemobile" value="">
            </div>
            <span class="helpLine">[Enter the Mobile Number without 91 or +91 as 9999988888]</span>

        </div>
    </div>
    <div class="row lightgreen">
        <div class="col-md-5">
            <div class="form-group">
                <label>Gender<span class="red">*</span></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="transgender" value="Transgender">
                    <label class="form-check-label" for="transgender">Transgender</label>
                </div>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="nationality">Nationality<span class="red">*</span></label>
                <select class="form-control" id="nationality" name="nationality">
                    <option value="">Select Nationality</option>
                    @foreach ($nationality as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>


        </div>
    </div>

    <div class="row gray">
        <div class="col-md-5">
            <div class="form-group">
                <label>Are you a Person With Benchmark Disabilities (Divyangjan)<span class="red">*</span></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="disabilities" id="disabilities_yes" value="Yes">
                    <label class="form-check-label" for="disabilities_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="disabilities" id="disabilities_no" value="No">
                    <label class="form-check-label" for="disabilities_no">No</label>
                </div>

            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="percentage_Of_isability">Percentage Of Disability (Age relaxation available > 40%)<span
                        class="red">*</span></label>
                <select class="form-control" id="percentage_Of_isability" name="percentage_Of_isability" disabled>
                    <option value="">Select Percentage Of Disability</option>
                    <option value="40% - 50%">40% - 50%</option>
                    <option value="50% - 60%">50% - 60%</option>
                    <option value="60% - 70%">60% - 70%</option>
                    <option value="70% - 80%">70% - 80%</option>
                    <option value="80% - 90%">80% - 90%</option>
                    <option value="90% - 100%">90% - 100%</option>
                </select>
            </div>


        </div>
    </div>
    <div class="row lightgreen">
        <div class="col-md-12">
            <div class="form-group">
                <label>Type of Benchmark Disability<span class="red">*</span></label><br>

                <div id="disabilityCheckboxes">
                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox"
                            name="disability_types[]" id="disability_1" value="1"><label class="form-check-label"
                            for="disability_1">D</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox"
                            name="disability_types[]" id="disability_2" value="2"><label class="form-check-label"
                            for="disability_2">HH</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox"
                            name="disability_types[]" id="disability_3" value="3"><label class="form-check-label"
                            for="disability_3">OL</label></div>
                </div>
                <span class="helpLine">D=Deaf, HH=Hard of Hearing, OA=One Arm, OL=One Leg, LC=Leprosy
                    Cured, Dw=Dwarfism, AAV=Acid Attack Victims, ASD=Autism Spectrum Disorder (M= Mild,
                    MoD= Moderate), SLD=Specific Learning Disability, MI=Mental Illness, MD=Multiple
                    Disabilities, CP=Cerebral Palsy, LV=Low Vision, BL=Both Leg, BA=Both Arms</span>
            </div>
        </div>

    </div>
    <div class="row gray">
        <div class="col-md-5">
            <div class="form-group">
                <label for="disability_certificate_no">Disability Certificate No<span class="red">*</span></label>
                <input type="text" class="form-control" id="disability_certificate_no" name="disability_certificate_no"
                    disabled>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="disability_certificate_date">Date of issue (Disability Certificate)<span
                        class="red">*</span></label>
                <input type="date" class="form-control" id="disability_certificate_date"
                    name="disability_certificate_date" disabled>
            </div>


        </div>
    </div>
    <div class="row lightgreen">
        <div class="col-md-5">
            <div class="form-group">
                <label for="Caste">Caste <span class="red">*</span></label>
                <select class="form-control" id="Caste" name="caste">
                    <option value="">Select Caste </option>
                    @foreach ($caste as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="caste_certificate_no">Caste Certificate No<span class="red">*</span></label>
                <input type="text" class="form-control" id="caste_certificate_no" name="caste_certificate_no" disabled>
            </div>
        </div>
    </div>
    <div class="row gray">
        <div class="col-md-5">
            <div class="form-group">
                <label for="caste_certificate_date">Date of Issue (Caste Certificate) <span class="red">*</span></label>
                <input type="date" class="form-control" id="caste_certificate_date" name="caste_certificate_date"
                    disabled>

            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>Non-Creamy Layer Category<span class="red">*</span></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="non_creamy_layer" id="non_creamy_layer_yes"
                        value="Yes" disabled>
                    <label class="form-check-label" for="non_creamy_layer_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="non_creamy_layer" id="non_creamy_layer_no"
                        value="No" disabled>
                    <label class="form-check-label" for="non_creamy_layer_no">No</label>
                </div>

            </div>
        </div>
    </div>
    <div class="row lightgreen">
        <div class="col-md-5">
            <div class="form-group">
                <label for="non_creamy_layer_certificate_no">Non-Creamy Layer Certificate No<span
                        class="red">*</span></label>
                <input type="text" class="form-control" id="non_creamy_layer_certificate_no"
                    name="non_creamy_layer_certificate_no" disabled>

            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="non_creamy_layer_certificate_date">Date of Issue (Non-Creamy Layer Certificate)<span
                        class="red">*</span></label>
                <input type="date" class="form-control" id="non_creamy_layer_certificate_date"
                    name="non_creamy_layer_certificate_date" disabled>

            </div>
        </div>
    </div>
    <div class="row gray">
        <div class="col-md-5">
            <div class="form-group">
                <label>Are you an Ex-Servicemen<span class="red">*</span></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ex_servicemen" id="ex_servicemen_yes"
                        value="Yes">
                    <label class="form-check-label" for="ex_servicemen_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ex_servicemen" id="ex_servicemen_no" value="No">
                    <label class="form-check-label" for="ex_servicemen_no">No</label>
                </div>

            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="ex_servicemen_certificate_no">Discharge Certificate No<span class="red">*</span></label>
                <input type="text" class="form-control" id="ex_servicemen_certificate_no"
                    name="ex_servicemen_certificate_no" disabled>

            </div>
        </div>
    </div>
    <div class="row lightgreen">
        <div class="col-md-5">
            <div class="form-group">
                <label for="ex_servicemen_certificate_date">Date of Issue (Discharge Certificate)<span
                        class="red">*</span></label>
                <input type="date" class="form-control" id="ex_servicemen_certificate_date"
                    name="ex_servicemen_certificate_date" disabled>

            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="ex_servicemen_certificate_period">Period of Service (in years)<span
                        class="red">*</span></label>
                <input type="text" class="form-control" id="ex_servicemen_certificate_period"
                    name="ex_servicemen_certificate_period" disabled>

            </div>
        </div>
    </div>
    <div class="row gray">
        <div class="col-md-5">
            <div class="form-group">
                <label for="date_of_birth">Date Of Birth<span class="red">*</span></label>
                <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" disabled>

            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">

            <div class="form-group">
                <label for="ex_servicemen_certificate_period">Candidate's Age as on 30/01/2024 <span
                        class="red">*</span></label>
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="year" name="year">
                    </div>
                    <div class="col-md-2">
                        <span>Years</span>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="month" name="month">
                    </div>
                    <div class="col-md-2">
                        <span>Months</span>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="day" name="day">
                    </div>
                    <div class="col-md-2">
                        <span>Days</span>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="row gray">
        <div class="col-md-12">
            <div class="form-group">

                <label for="declare">
                    <input type="checkbox" class="form-check-input" id="declare" name="declare">
                    I hereby declare that I have read very carefully the advertisement/corrigendum published by Oil
                    India Limited in mentioned all desirable qualifications and conditions. I accept all mentioned
                    conditions & have desired qualifications, experiences in said advertisement. If at any stage, any
                    discrepancy or falsehood is found or has been concealed, then my application/candidature is liable
                    to be rejected/cancelled by Oil India Limited.


                </label>
            </div>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>


</form>