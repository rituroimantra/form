@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#db2016">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 style="color:white">Basic Details:</h4>
                        </div>
                        <div class="col-md-9" style="text-align:right">
                            <p style="color:white">In online form all the fields marked with red asterisk (*) are
                                compulsory fields.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ url('/basic-details-submit') }}" id="formtwo">
                        @csrf
                        <div class="row box-horizontal">
                            <div class="col-md-12">
                                <div>
                                    <span>Personal Details</span>
                                </div>
                            </div>
                        </div>
                        <div class="row gray">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="father">Father's Name
                                        *</label>
                                    <input type="text" class="form-control" id="father" name="father">

                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="mother">Mother's Name .</label>
                                    <input type="text" class="form-control" id="mother" name="mother">
                                </div>

                            </div>
                        </div>
                        <div class="row lightgreen">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Current Marital Status</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="marital_status" id="Married"
                                            value="Married">
                                        <label class="form-check-label" for="Married">Married</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="marital_status"
                                            id="Unmarried" value="Unmarried">
                                        <label class="form-check-label" for="Unmarried">Unmarried</label>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row box-horizontal">
                            <div class="col-md-12">
                                <div>
                                    <span>Permanent Address:</span>
                                </div>
                            </div>
                        </div>
                        <div class="row gray">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pin_code">Pin Code</label>
                                    <input type="number" class="form-control" id="pin_code" name="permanent_pin_code"  placeholder="Enter Pincode">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City / District</label>
                                    <input type="text" class="form-control" id="city" name="permanent_city" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="permanent_state" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row lightgreen">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address_one">Address Line 1</label>
                                    <input type="text" class="form-control" id="address_one" name="permanent_address_one">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address_two">Address Line 2</label>
                                    <input type="text" class="form-control" id="address_two" name="permanent_address_two">

                                </div>
                            </div>
                        </div>
                        <div class="row box-horizontal">
                            <div class="col-md-12">
                                <div>
                                    <span>Correspondence Address:</span>
                                </div>
                            </div>
                        </div>
                        <div class="row gray">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pin_code">Pin Code</label>
                                    <input type="number" class="form-control" id="correspondence_pin_code" name="correspondence_pin_code" placeholder="Enter Pincode">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City / District</label>
                                    <input type="text" class="form-control" id="correspondence_city" name="correspondence_city" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="correspondence_state" name="correspondence_state" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row lightgreen">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address_one">Address Line 1</label>
                                    <input type="text" class="form-control" id="correspondence_address_one" name="correspondence_address_one">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address_two">Address Line 2</label>
                                    <input type="text" class="form-control" id="correspondence_address_two" name="correspondence_address_two">

                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')

<script>
    function fetchDatatwo(pincode) {
    fetch(`https://api.postalpincode.in/pincode/${pincode}`)
    .then(response => response.json())
    .then(data => {
        // Check if the API returned valid data
        if (data && data.length > 0 && data[0].Status === "Success") {
            // Extract state, city, and other relevant information
            const state = data[0].PostOffice[0].State;
            const city = data[0].PostOffice[0].District;
            const pincode = data[0].PostOffice[0].Pincode;

            // Update the UI with the extracted data
            document.getElementById('correspondence_state').value = state;
            document.getElementById('correspondence_city').value = city;
            document.getElementById('correspondence_pin_code').value = pincode;
        } else {
            console.error("Invalid pincode or data not found");
        }
    })
    .catch(error => {
        console.error("Error fetching data:", error);
    });
}
    document.getElementById('correspondence_pin_code').addEventListener('blur', function() {
    const pincode = this.value.trim(); // Get the pincode entered by the user
    if (pincode) {
        // If pincode is not empty, fetch data
        fetchDatatwo(pincode);
    }
});
function fetchData(pincode) {
    fetch(`https://api.postalpincode.in/pincode/${pincode}`)
    .then(response => response.json())
    .then(data => {
        // Check if the API returned valid data
        if (data && data.length > 0 && data[0].Status === "Success") {
            // Extract state, city, and other relevant information
            const state = data[0].PostOffice[0].State;
            const city = data[0].PostOffice[0].District;
            const pincode = data[0].PostOffice[0].Pincode;

            // Update the UI with the extracted data
            document.getElementById('state').value = state;
            document.getElementById('city').value = city;
            document.getElementById('pin_code').value = pincode;
        } else {
            console.error("Invalid pincode or data not found");
        }
    })
    .catch(error => {
        console.error("Error fetching data:", error);
    });
}
    document.getElementById('pin_code').addEventListener('blur', function() {
    const pincode = this.value.trim(); // Get the pincode entered by the user
    if (pincode) {
        // If pincode is not empty, fetch data
        fetchData(pincode);
    }
});
$(document).ready(function() {
    $('#formtwo').submit(function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Remove any existing error messages
        $('.text-danger').remove();

        // Serialize the form data
        var formData = $(this).serialize();

        // Send an AJAX request to the server using POST method
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            success: function(response) {
                // Handle success response
                console.log(response);
                // Optionally, redirect to another page
                window.location.replace('/educational-qualifications');
            },
            error: function(xhr, status, error) {
                // Handle error response
                var errors = xhr.responseJSON.errors;
                var firstErrorField = null;
                $.each(errors, function(field, messages) {
                    // Display error messages for each field
                    var errorHtml = '';
                    if (firstErrorField === null) {
                        firstErrorField = field;
                    }
                    $.each(messages, function(index, message) {
                        errorHtml += '<span class="text-danger">' +
                            message + '</span>';
                    });
                    $('[name="' + field + '"]').after(errorHtml);
                });

                // Scroll to the first field with an error message and focus on it
                if (firstErrorField !== null) {
                    var $firstErrorField = $('[name="' + firstErrorField + '"]');
                    $firstErrorField.focus();
                }
            }
        });
    });

    // Remove error messages when the form fields are interacted with
    $('#formone input, #formone select').change(function() {
        $(this).next('.text-danger').remove();
    });
});
</script>

@endpush