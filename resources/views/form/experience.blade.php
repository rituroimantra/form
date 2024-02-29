@extends('layouts.app')

@section('content')
<style>
#experienceTableData_length {
    display: none;
}

#experienceTableData_filter {
    display: none;
}

#experienceTableData_info {
    display: none;
}

#experienceTableData_paginate {
    display: none;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#db2016">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 style="color:white">Experience Details:</h4>
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
                    <form method="POST" action="{{ url('/educational-qualifications-submit') }}" id="formthree"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Your Blade template file e.g., experience.blade.php -->

                        <form id="experienceForm">
                            <div class="form-group">
                                <label>Have you been an employee?</label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="employee" value="yes"> Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="employee" value="no"> No
                                </label>
                            </div>

                            <div id="experienceTable" style="display: none;">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Experience
                                </button>

                                <table id="experienceTableData" class="table">
                                    <thead>
                                        <tr>
                                            <th>Name of Organization</th>
                                            <th>Brief Job Description</th>
                                            <th>Joining Date</th>
                                            <th>Leaving Date</th>
                                            <th>Experience Certificate</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="experienceTableBody">
                                        <!-- Experience rows will be dynamically added here -->
                                    </tbody>
                                </table>
                            </div>


                        </form>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="experienceModalLabel">Add Experience</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addExperienceForm" enctype="multipart/form-data">
                                            <!-- Add enctype attribute for file upload -->
                                            <div class="form-group">
                                                <label for="organization">Name of Organization</label>
                                                <input type="text" class="form-control" id="organization"
                                                    name="organization" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jobDescription">Brief Job Description</label>
                                                <input type="text" class="form-control" id="jobDescription"
                                                    name="jobDescription" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="joiningDate">Joining Date</label>
                                                <input type="date" class="form-control" id="joiningDate"
                                                    name="joiningDate" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="leavingDate">Leaving Date</label>
                                                <input type="date" class="form-control" id="leavingDate"
                                                    name="leavingDate">
                                            </div>
                                            <div class="form-group">
                                                <label for="certificate">Experience Certificate</label>
                                                <input type="file" class="form-control-file" id="certificate"
                                                    name="certificate" accept=".pdf,.doc,.docx" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>

                                    </div>
                                   
                                </div>
                            </div>
                        </div>


                        <div class="form-footer">
                            <button type="submit" class="btn">Submit</button>
                            <button type="button" class="btn">Back</button>
                        </div>
                        <!-- Button trigger modal -->

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// JavaScript code (you can include it in a separate .js file)

// Function to show or hide the experience table based on radio button selection
function toggleExperienceTable() {
    var isEmployee = $('input[name=employee]:checked').val() === 'yes';
    var $experienceTable = $('#experienceTable'); // Cache the element for performance

    // Check if the element exists before toggling its visibility
    if ($experienceTable.length > 0) {
        $experienceTable.toggle(isEmployee);
    }

    if (isEmployee) {
        $.ajax({
            url: "{{ route('get.experience.details') }}",
            type: "GET",
            success: function(response) {
                // Check if DataTables is already initialized
                if ($.fn.DataTable.isDataTable('#experienceTableData')) {
                    // If DataTables is already initialized, destroy the existing instance
                    $('#experienceTableData').DataTable().destroy();
                }

                // Initialize DataTables with the fetched data
                var experienceTableData = $('#experienceTableData').DataTable({
                    "processing": true,
                    "serverSide": false, // Since data is already fetched, set serverSide to false
                    "data": response, // Use the response data as the table data
                    "columns": [{
                            "data": "organization"
                        },
                        {
                            "data": "job_description"
                        },
                        {
                            "data": "joining_date"
                        },
                        {
                            "data": "leaving_date"
                        },
                        {
                            "data": "certificate",
                            "render": function(data, type, row) {
                                // If the column data is a URL, render it as a clickable link
                                if (type === 'display' && data) {
                                    return '<a href="' + data +
                                        '" target="_blank">certificate </a>';
                                }
                                return data;
                            }
                        },
                        // Modify the render function for the edit and delete buttons
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                // Render edit and delete buttons for each row
                                if (type === 'display') {
                                    // Include the row id as a data attribute in the buttons
                                    return '<button class="btn btn-primary btn-sm edit-btn" data-row-id="' +
                                        row.id + '">Edit</button>' +
                                        '<button class="btn btn-danger btn-sm delete-btn" data-row-id="' +
                                        row.id + '">Delete</button>';
                                }
                                return data;
                            }
                        }


                    ]
                });
                return experienceTableData;
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    $('#addExperienceForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: '/experience-details-submit',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content') // Include CSRF token in headers
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                var experienceTableData =
                    toggleExperienceTable(); // Retrieve the DataTable instance
                if (experienceTableData) {
                    experienceTableData.ajax.reload(); // Reload the DataTable
                }
                // Close the experience model (assuming it's a Bootstrap modal)
                $('#exampleModal').modal('hide');
                // You can update your table here with the response data
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    });


}


// Handle edit button click

   // Handle edit button click
   $('#experienceTableData').on('click', '.edit-btn', function(e) {
    e.preventDefault(); // Prevent the default action (e.g., form submission or link click)

    // Retrieve the row id associated with the clicked edit button
    var rowId = $(this).data('row-id');
    // Handle edit logic here using the row id
    console.log('Edit clicked for row with id:', rowId);
});

// Handle delete button click
$('#experienceTableData').on('click', '.delete-btn', function(e) {
    e.preventDefault(); // Prevent the default action (e.g., form submission or link click)

    // Retrieve the row id associated with the clicked delete button
    var rowId = $(this).data('row-id');

    // Show a confirmation dialog using SweetAlert
    swal.fire({
        title: 'Are you sure?',
        text: 'You are about to delete this item!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform an AJAX request to delete the item from the server
            $.ajax({
                url: '/get-experience-details/' + rowId, // Adjust the URL to your delete endpoint
                type: 'DELETE', // Use the appropriate HTTP method for deletion
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
                },
                success: function(response) {
                    // Handle successful deletion
                    console.log('Item deleted:', response);
               
                    var experienceTableData =
                    toggleExperienceTable(); // Retrieve the DataTable instance
                if (experienceTableData) {
                    experienceTableData.ajax.reload(); // Reload the DataTable
                }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error('Error deleting item:', error);
                }
            });
        }
    });
});


// Event listener for radio button change
$('input[name=employee]').change(function() {
    toggleExperienceTable();
});
</script>

@endpush