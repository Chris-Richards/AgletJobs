@extends('layouts.app') 

@section('content')
<link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7235471534491396"
     crossorigin="anonymous"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Free Resume Generator</h4>
                    <span>Use our free resume generator tool to create your perfect resume.</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Personal Details</h5>
                    <span>Aglet Jobs does not save any data entered into the resume generator.</span>
                    <hr>
                    <form class="row g-3" action="/resume/create" method="POST">
                        @csrf
                        <!-- PERSONAL DETAILS -->
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mobile</label>
                            <input class="form-control" type="number" name="number" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Suburb</label>
                            <input class="form-control" type="text" name="suburb" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">State</label>
                            <input class="form-control" type="text" name="state" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Postcode</label>
                            <input class="form-control" type="text" name="postcode" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Summary (This is where you sell yourself to a potential employer)</label>
                            <textarea class="form-control" name="summary" rows="4" required></textarea>
                        </div>
                        <!-- SKILLS -->
                        <div class="col-md-12">
                            <label class="form-label">Skills (Press Enter/Return to save a skill) - Max 12</label>
                            <input name="skills" class="form-control" required>
                        </div>
                        <hr>
                        <!-- UPTO LAST 4 JOBS -->
                        <h5 style="margin:0;">Most Recent Career History (Up to 3 entries)</h5>
                        <hr>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Job 1</button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Role Title</label>
                                                <input type="text" name="job-1-title" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" name="job-1-company" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Start Date</label>
                                                <input type="text" name="job-1-start" class="form-control" placeholder="MM-YYYY">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Finish Date (Leave blank if current)</label>
                                                <input type="text" name="job-1-finish" class="form-control" placeholder="MM-YYYY">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Summary of responsibilities/achievements</label>
                                                <textarea class="form-control" name="job-1-summary" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Job 2</button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Role Title</label>
                                                <input type="text" name="job-2-title" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" name="job-2-company" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Start Date</label>
                                                <input type="text" name="job-2-start" class="form-control" placeholder="MM-YYYY">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Finish Date</label>
                                                <input type="text" name="job-2-finish" class="form-control" placeholder="MM-YYYY">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Summary of responsibilities/achievements</label>
                                                <textarea class="form-control" name="job-2-summary" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Job 3</button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Role Title</label>
                                                <input type="text" name="job-3-title" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" name="job-3-company" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Start Date</label>
                                                <input type="text" name="job-3-start" class="form-control" placeholder="MM-YYYY">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Finish Date</label>
                                                <input type="text" name="job-3-finish" class="form-control" placeholder="MM-YYYY">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Summary of responsibilities/achievements</label>
                                                <textarea class="form-control" name="job-3-summary" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- EDUCATION -->
                        <hr>
                        <h5 style="margin:0;">Education (Up to 2 entries)</h5>
                        <hr>
                        <div class="accordion" id="educationAccordian">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="EheadingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#educationOne" aria-expanded="false" aria-controls="educationOne">Education 1</button>
                                </h2>
                                <div id="educationOne" class="accordion-collapse collapse" aria-labelledby="EheadingOne" data-bs-parent="#educationAccordian">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Course Name</label>
                                                <input type="text" name="edu-1-name" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Institution Name</label>
                                                <input type="text" name="edu-1-institution" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Graduation Date</label>
                                                <input type="text" name="edu-1-finish" class="form-control" placeholder="MM-YYYY">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="EheadingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#educationTwo" aria-expanded="false" aria-controls="educationTwo">Education 2</button>
                                </h2>
                                <div id="educationTwo" class="accordion-collapse collapse" aria-labelledby="EheadingTwo" data-bs-parent="#educationAccordian">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Course Name</label>
                                                <input type="text" name="edu-2-name" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Institution Name</label>
                                                <input type="text" name="edu-2-institution" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Graduation Date</label>
                                                <input type="text" name="edu-2-finish" class="form-control" placeholder="MM-YYYY">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- QUALIFICATIONS -->
                        <hr>
                        <h5 style="margin:0;">Qualifications</h5>
                        <hr>
                        <div class="col-md-12">
                            <label class="form-label">Qualifications/Tickets (Press Enter/Return to save entry)</label>
                            <input name="tickets" class="form-control">
                        </div>

                        <!-- REFERENCES -->
                        <hr>
                        <h5 style="margin:0;">References (Up to 2 entries)</h5>
                        <hr>

                        <div class="accordion" id="referenceAccordian">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="RheadingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#referenceOne" aria-expanded="false" aria-controls="referenceOne">Reference 1</button>
                                </h2>
                                <div id="referenceOne" class="accordion-collapse collapse" aria-labelledby="RheadingOne" data-bs-parent="#referenceAccordian">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="ref-1-name" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Position Title</label>
                                                <input type="text" name="ref-1-position" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" name="ref-1-company" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Mobile/Email</label>
                                                <input type="text" name="ref-1-contact" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="RheadingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#referenceTwo" aria-expanded="false" aria-controls="referenceTwo">Reference 2</button>
                                </h2>
                                <div id="referenceTwo" class="accordion-collapse collapse" aria-labelledby="RheadingTwo" data-bs-parent="#referenceAccordian">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="ref-2-name" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Position Title</label>
                                                <input type="text" name="ref-2-position" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" name="ref-2-company" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Mobile/Email</label>
                                                <input type="text" name="ref-2-contact" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-danger btn-lg">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var input = document.querySelector('input[name=skills]');
        // initialize Tagify on the above input node reference
        new Tagify(input, {
            whitelist: [],
            dropdown: {
                classname: "color-blue",
                enabled: 0, // show the dropdown immediately on focus
                maxItems: 12,
                position: "text", // place the dropdown near the typed text
                closeOnSelect: false, // keep the dropdown open after selecting a suggestion
                highlightFirst: true
            }
        });
        input.addEventListener('change', onChange)

        function onChange(e) {
            // outputs a String
            console.log(e.target.value)
        }

        var input2 = document.querySelector('input[name=tickets]');
        // initialize Tagify on the above input node reference
        new Tagify(input2, {
            whitelist: [],
            dropdown: {
                classname: "color-blue",
                enabled: 0, // show the dropdown immediately on focus
                maxItems: 24,
                position: "text", // place the dropdown near the typed text
                closeOnSelect: false, // keep the dropdown open after selecting a suggestion
                highlightFirst: true
            }
        });
        input2.addEventListener('change', onChange)

        function onChange(e) {
            // outputs a String
            console.log(e.target.value)
        }
    });
</script> @endsection