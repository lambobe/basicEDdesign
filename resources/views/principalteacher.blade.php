@include('templates.principalheader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa; /* Light background */
        margin: 0;
        padding: 0;
    }

    .header-container {
        display: flex; 
        align-items: center; 
        background-color: #0c3b6d; 
        color: white;
        padding: 15px; 
    }

    h1 {
        margin: 0; 
        font-size: 20px;
    }

    .w3-sidebar {
        background-color: #0c3b6d; 
        color: white;
        width: 250px; /* Fixed width for sidebar */
        position: fixed; /* Fixed position */
        height: 100%; /* Full height */
        padding-top: 20px; /* Space at the top */
        display: none; /* Initially hidden */
    }

    .form-container {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Set a max width for the form */
        margin: auto; /* Center the form */
        margin-top: 20px; /* Space from the top */
    }

    .form-group {
        margin-bottom: 1.5rem; /* Increase space between form groups */
    }

    label {
        font-weight: bold; /* Make labels bold */
    }

    .subjects {
        margin-top: 10px;
        border: 1px solid #ddd; /* Add a border around subject lists */
        padding: 10px;
        border-radius: 5px;
        display: none; /* Initially hidden */
    }

    .checkbox-group div {
        margin-left: 1.5rem; /* Indent checkboxes for clarity */
    }

    .text-center {
        margin-top: 1.5rem; /* Space above the button */
    }

    .btn-primary {
        background-color: #17a2b8;
        border: none;
        color: white;
        padding: 10px;
        border-radius: 4px;
        transition: background-color 0.3s;
        width: 100%; /* Make the button full width */
    }

    .btn-primary:hover {
        background-color: #138496;
    }
</style>

<div id="main">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1>TEACHERS AND SUBJECTS</h1>
    </div>
    <br>
    <div class="container d-flex justify-content-center align-items-start" style="min-height: 80vh;">
        <div class="form-container">
            <h1 class="text-center">Assign Teacher to Subject</h1>

            <form action="/principalteacher" method="POST" id="myForm">
                @csrf
                <div class="form-group">
                    <label for="teacher">Teacher</label>
                    <select class="form-control" id="teacher" name="name" required>
                        <option value="">Select a Teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher['id'] }}">
                                {{ $teacher['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="grade">Select Grade Level</label>
                    <select class="form-control" id="grade" name="grade" onchange="showSubjects(this.value)">
                        <option value="">Select Grade</option>
                        @foreach (range(1, 10) as $grade)
                            <option value="Grade {{ $grade }}">Grade {{ $grade }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div id="subjects" class="checkbox-group">
                    @foreach ([
                        'Grade 1' => ["Mother tongue", "Filipino", "Reading", "Language", "Mathematics", "Science", "AP", "ESP", "Computer", "MAPEH"],
                        'Grade 2' => ["Mother tongue", "Filipino", "Reading", "Language", "Mathematics", "Science", "AP", "ESP", "Computer", "MAPEH"],
                        'Grade 3' => ["Mother tongue", "Filipino", "Reading & Phonics", "Language & Spelling", "Mathematics", "Science", "AP", "ESP", "Computer", "MAPEH"],
                        'Grade 4' => ["Mother tongue", "Filipino", "Reading", "Language", "Mathematics", "Science", "AP", "ESP", "Computer", "MAPEH"],
                        'Grade 5' => ["Mother tongue", "Filipino", "Reading", "Language", "Mathematics", "Science", "AP", "ESP", "Computer", "MAPEH"],
                        'Grade 6' => ["Filipino", "Reading", "Language", "Mathematics", "Science", "AP", "ESP", "Computer", "HELE (EPP)", "MAPEH"],
                        'Grade 7' => ["Filipino", "English", "Mathematics", "Science", "AP", "ESP", "TLE/Computer", "MAPEH"],
                        'Grade 8' => ["Filipino", "English", "Mathematics", "Science", "AP", "ESP", "TLE/Computer", "MAPEH"],
                        'Grade 9' => ["Filipino", "English", "Mathematics", "Science", "AP", "ESP", "TLE", "MAPEH"],
                        'Grade 10' => ["Filipino", "English", "Mathematics", "Science", "AP", "ESP", "TLE", "MAPEH"]
                    ] as $grade => $subjects)
                        <div class="subjects" id="{{ strtolower(str_replace(' ', '-', $grade)) }}">
                            <h4>{{ $grade }} Subjects:</h4>
                            @foreach ($subjects as $subject)
                                <div>
                                    <input type="checkbox" id="{{ strtolower(str_replace(' ', '-', $subject)) }}" name="subject[]" value="{{ $subject }}">
                                    <label for="{{ strtolower(str_replace(' ', '-', $subject)) }}">{{ $subject }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            
                <input type="hidden" name="concatenated_subjects" id="concatenated_subjects">
            
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            
            <script>
                document.getElementById('myForm').onsubmit = function() {
                    const checkboxes = document.querySelectorAll('input[name="subject[]"]:checked');
                    const selectedSubjects = Array.from(checkboxes).map(cb => cb.value);
                    const concatenatedSubjects = selectedSubjects.join(', ');
                    document.getElementById('concatenated_subjects').value = concatenatedSubjects;
                    console.log('Concatenated Subjects:', concatenatedSubjects);
                    toastr.success('Teacher assigned successfully.');
                };

                function showSubjects(grade) {
                    document.querySelectorAll('.subjects').forEach(subjectList => {
                        subjectList.style.display = 'none';
                    });
                    if (grade) {
                        document.getElementById(grade.toLowerCase().replace(' ', '-')).style.display = 'block';
                    }
                }
            </script>
        </div>
    </div>
</div>

@include('templates.principalfooter')