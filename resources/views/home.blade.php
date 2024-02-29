@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#db2016">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 style="color:white">Signup:</h4>
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

                    @include('form.reg')
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
   
<script>
const wclRadioButtons = document.querySelectorAll('input[name="wcl"]');
const durationOilInput = document.getElementById('durationoil');
const keyNoInput = document.getElementById('keyno');
const employmEntexchange = document.getElementById('employmentexchange');
const employmEntExchangeNo = document.getElementById('employmentexchangeno');
// Add event listener to the radio buttons
wclRadioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('change', function() {
        // Check if "Yes" is selected
        if (this.value === 'yes') {
            durationOilInput.disabled = false;
            keyNoInput.disabled = false;
            employmEntexchange.disabled = true;
            employmEntExchangeNo.disabled = true;
            employmEntExchangeNo.value = '';
            employmEntexchange.value = ''; 
         
        } else {
            durationOilInput.disabled = true;
            keyNoInput.disabled = true;
            employmEntexchange.disabled = false;
            employmEntExchangeNo.disabled = false;
            durationOilInput.value = '';
            keyNoInput.value = '';
            
        }
    });
});
$(document).ready(function() {
    // Set default readonly state
    $('#disabilityCheckboxes input[type="checkbox"]').prop('disabled', true);
    $('#disability_certificate_no, #disability_certificate_date').prop('disabled', true);

    $('input[name="disabilities"]').on('change', function() {
        var isDisabled = ($(this).val() === 'No');
        $('#disabilityCheckboxes input[type="checkbox"]').prop('disabled', isDisabled);
        $('#disability_certificate_no, #disability_certificate_date,#percentage_Of_isability').prop(
            'disabled', isDisabled);
    });
    $('#post').on('change', function() {
        var postId = $(this).val();
        $.ajax({
            url: "{{ route('getDisabilityTypes') }}",
            type: "GET",
            data: {
                postId: postId
            },
            success: function(response) {
                // Check if response contains an 'error' property
                if (response.error) {
                    // If error is present, display the error message
                    $('#disabilityCheckboxes').empty().text(response.error);
                } else {
                    // If no error, proceed to populate the checkboxes
                    $('#disabilityCheckboxes').empty();
                    $.each(response, function(id, name) {
                        var checkbox =
                            '<div class="form-check form-check-inline">' +
                            '<input class="form-check-input" type="checkbox" name="disability_types[]" id="disability_' +
                            id + '" value="' + id + '" disabled>' +
                            '<label class="form-check-label" for="disability_' +
                            id +
                            '">' + name + '</label>' +
                            '</div>';
                        $('#disabilityCheckboxes').append(checkbox);
                    });
                }
            },
            error: function(xhr, status, error) {
                // If there's an error with the AJAX request itself, log it
                console.error(xhr.responseText);
                // Optionally, you can also display a generic error message to the user
                $('#disabilityCheckboxes').empty().text('Not Found.');
            }
        });
    });

});
$(document).ready(function() {
    $('#Caste').on('change', function() {

        var caste = $(this).val();

        // Reset all fields to readonly
        $('#caste_certificate_no, #caste_certificate_date, #non_creamy_layer, #non_creamy_layer_certificate_no, #non_creamy_layer_certificate_date')
            .prop('disabled', true);

        if (caste === '1') { // General caste

            // Make fields readonly
            $('#caste_certificate_no, #caste_certificate_date').prop('disabled', true);
            $('input[name="non_creamy_layer"]').prop('disabled', true);
        } else if (caste === '2') { // Other Backward Classes caste
            // Make fields editable

            $('#caste_certificate_no, #caste_certificate_date').prop('disabled', false);
            $('input[name="non_creamy_layer"]').prop('disabled', false);
        } else if (caste === '3' || caste === '4') { // Scheduled Tribes or Scheduled Caste caste
            // Make fields editable
            $('#caste_certificate_no, #caste_certificate_date').prop('disabled', false);
            $('input[name="non_creamy_layer"]').prop('disabled', true);
        }
    });
    $('input[name="non_creamy_layer"]').on('change', function() {
        var value = $(this).val();

        if (value === 'Yes') {
            $('#non_creamy_layer_certificate_no, #non_creamy_layer_certificate_date').prop('disabled',
                false);
        } else {
            $('#non_creamy_layer_certificate_no, #non_creamy_layer_certificate_date').prop('disabled',
                true);
        }
    });
    $('input[name="ex_servicemen"]').on('change', function() {
        var value = $(this).val();

        if (value === 'Yes') {
            $('#ex_servicemen_certificate_no, #ex_servicemen_certificate_date,#ex_servicemen_certificate_period')
                .prop('disabled',
                    false);
        } else {
            $('#ex_servicemen_certificate_no, #ex_servicemen_certificate_date,#ex_servicemen_certificate_period')
                .prop('disabled',
                    true);
        }
    });
});
$(function() {
    // Function to enable/disable date of birth field
    function toggleDateOfBirth() {
        var postValue = $('#post').val();
        var disabilitiesValue = $('input[name="disabilities"]:checked').val();
        var casteValue = $('#Caste').val();
        var exServicemenValue = $('input[name="ex_servicemen"]:checked').val();

        // Enable date of birth if all conditions are met
        if (postValue && disabilitiesValue && casteValue && exServicemenValue) {
            $('#date_of_birth').prop('disabled', false).datepicker('option', 'disabled', false);
        } else {
            $('#date_of_birth').prop('disabled', true).datepicker('option', 'disabled', true);
        }
    }

    // Calculate min and max date range
    var currentDate = new Date();
    var maxDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate
        .getDate()); // 18 years ago
    var minDate = new Date(currentDate.getFullYear() - 30, currentDate.getMonth(), currentDate
        .getDate()); // 30 years ago

    // Initialize date picker
    $('#date_of_birth').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: (minDate.getFullYear()) + ':' + (maxDate.getFullYear()),
        maxDate: maxDate,
        minDate: minDate,
        onSelect: function(selectedDate) {
            var birthDate = new Date(selectedDate);
            var currentDate = new Date();

            // Calculate age
            var ageYear = currentDate.getFullYear() - birthDate.getFullYear();
            var ageMonth = currentDate.getMonth() - birthDate.getMonth();
            var ageDay = currentDate.getDate() - birthDate.getDate();

            // Adjust age if birth month is greater than current month
            if (ageMonth < 0 || (ageMonth === 0 && ageDay < 0)) {
                ageYear--;
                ageMonth = 12 + ageMonth;
            }

            // Update input fields
            $('#year').val(ageYear);
            $('#month').val(ageMonth);
            $('#day').val(ageDay);
        }
    });

    // Event listeners for change in other fields
    $('#post, input[name="disabilities"], #Caste, input[name="ex_servicemen"]').change(function() {
        toggleDateOfBirth();
    });

    // Initial check to enable/disable date of birth field
    toggleDateOfBirth();
});
$(document).ready(function() {
    $('#formone').submit(function(event) {
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
                window.location.replace('/basic-details');
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