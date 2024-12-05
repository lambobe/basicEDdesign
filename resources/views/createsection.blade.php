
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
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
                background-color: rgba(8, 16, 66, 1);
                color: white;
                padding: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
                }

            .container {
                margin-top:15px;
                display: flex;
                justify-content: space-between;
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                padding: 40px;
            }
            .w3-container h1{
                margin-left:-60px;
                margin-top:5px;
             
            }
            h1 {
                margin: 0; 
                font-size: 20px;
             }
            h2 {
                text-align: center;
                color: #2c3e50;
                margin-bottom: 20px;
                font-size: 24px;
                font-weight: 600;
            }

            .alert {
                background-color: #f8d7da; /* Light red background */
                color: #721c24; /* Dark red text */
                padding: 15px;
                border: 1px solid #f5c6cb; /* Light red border */
                border-radius: 5px;
                width: 100%; /* Full width of the container */
                margin-bottom: 20px; /* Space below the alert */
                display: flex;
                flex-direction: column; /* Stack items vertically */
            }

            .alert ul {
                list-style-type: none; /* Remove bullet points */
                margin: 0;
                padding: 0;
            }

            .alert li {
                margin: 5px 0; /* Space between error messages */
            }

            .form-section,
            .table-section {
                flex: 1;
                min-width: 300px;
                background: #f9f9f9;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            input, textarea, select {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            button {
                width: 50%;
                padding: 2px;
                background-color: rgba(8, 16, 66, 1);
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
                margin-top: 10px;
                transition: background-color 0.3s;
            }

            button:hover {
                background-color: #0056b3;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ccc;
            }

            th {
                background-color: rgba(8, 16, 66, 1);
                color: white;
            }

            tr:hover {
                background-color: #f1f1f1;
            }

            .icon-button {
                background: none;
                border: none;
                cursor: pointer;
                color: rgba(8, 16, 66, 1);
                font-size: 24px; /* Increased size for visibility */
                width: 36px; /* Set width */
                height: 36px; /* Set height */
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .icon-button:hover {
                color: #0056b3;
            }
            .w3-sidebar {
            background-image: url('image/ucbuild.png');
            background-size: cover;
            background-position: center;
            position: fixed;
            color: white;
            width: 220px;
            transition: width 0.3s;
            overflow-y: hidden;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
}

.w3-sidebar::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(8, 16, 66, 0.9);
    z-index: 1;
}

.profile-section,
.w3-bar-item {
    position: relative;
    z-index: 2;
}

.profile-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 6px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.profile-picture {
    width: 50px;
    height: 58px;
    border-radius: 80%;
    margin-bottom: 5px;
}

.w3-bar-item {
    display: flex;
    align-items: center;
    padding: 10px;
    text-decoration: none;
    transition: color 0.3s;
    border-radius: 5px;
    margin-right: 10px;
    margin-top: 15px;
    font-size: 14px;
}

/* Increased the size of the icons to 16px for better visibility */
.w3-bar-item svg {
    width: 16px;
    height: 16px;
    margin-right: 10px;
    transition: fill 0.5s;
}

.w3-bar-item:hover svg {
    fill: black;
}

.w3-bar-item.w3-button {
    color: rgb(255, 255, 255);
    border: none;
    border-radius: 5px;
    margin-bottom: 2px;
}

.w3-bar-item.w3-button:hover {
    background-color: #0004d6;
}

.w3-bar-item.active {
    background-color: rgba(240, 252, 126);
    color: rgba(3, 5, 74);
}

.uc-logo-container {
    position: relative;
    z-index: 2;
    text-align: center;
    margin: 0px 0px;
    background-color: rgba(255, 244, 231, 1);
    margin-top: 42%;
    padding: 14px;
}

.uc-logo {
    width: 120px;
    height: auto;
    margin-top: 5%;
    margin-bottom: 10px;
}

.profile-section a {
    text-decoration: none;
    color: rgba(203, 209, 208);
    margin-top: 5px;
    font-size: 12px;
}

.profile-section a:hover {
    color: white;
}

.profile-name {
    font-size: 13px;
    text-transform: uppercase;
}

.w3-bar-item.w3-button.w3-large {
    top: 0px;
    left: 185px;
    width: 30px;
    border-radius: 0;
    position:fixed;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.signout {
    margin-top: 100px;
}
      
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column; /* Stack items on smaller screens */
                padding:10px;
            }
            .form-section,
            .table-section {
                min-width: auto;
                margin-bottom: 20px;
            }

            h1 {
                font-size: 18px; /* Adjust heading size */
            }

            .nav-button {
                margin-bottom: 10px; /* Adjust button margin */
            }

            .content {
                margin: 10px; /* Reduce margin on smaller screens */
            }

            ul, ol {
                text-align: left; /* Align lists to the left on mobile */
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 16px; /* Further reduce heading size */
            }

            h2 {
                font-size: 18px; /* Adjust h2 size */
            }

            p {
                font-size: 14px; /* Adjust paragraph size */
            }
        }
        .burgericon{
            width:8%;
        }
        </style>
<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <div class="profile-section">
            <img src="image/cler.jpg" alt="Profile Picture" class="profile-picture">
            <span class="profile-name" style="text-align:center">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
            <a href="/principalprofile">View Profile</a>
        </div>
        <h5>
            <a href="/principal" class="w3-bar-item w3-button "><svg xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-house-check-fill" viewBox="0 0 16 16">
                <path
                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
                <path
                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514" />
            </svg> Home</a>
      
        <a href="/sectioning" class="w3-bar-item w3-button"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5" />
                <path
                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                <path
                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
            </svg>Assign Section</a>
        <a href="/principalteacher" class="w3-bar-item w3-button "><svg xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5" />
                <path
                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                <path
                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
            </svg> Faculty</a>
        <a href="/submittedgrades" class="w3-bar-item w3-button"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
                <path
                    d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z" />
                <path
                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                <path
                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
            </svg> Evaluate Grades</a>
            <a href="/createsection" class="w3-bar-item w3-button active"><svg xmlns="http://www.w3.org/2000/svg"
                width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                <path
                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z" />
                <path
                    d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4" />
            </svg> Create Section</a>
    
        <a href="/principalassessment" class="w3-bar-item w3-button"><svg xmlns="http://www.w3.org/2000/svg"
                width="16" height="16" fill="currentColor" class="bi bi-align-center" viewBox="0 0 16 16">
                <path
                    d="M8 1a.5.5 0 0 1 .5.5V6h-1V1.5A.5.5 0 0 1 8 1m0 14a.5.5 0 0 1-.5-.5V10h1v4.5a.5.5 0 0 1-.5.5M2 7a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
            </svg> Assessment</a>
            <div class="signout">
        <a href="/logout" class="w3-bar-item w3-button"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                <path fill-rule="evenodd"
                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
            </svg> Sign Out
        </a>
    </div>
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()"> &times;</button>
</div>
</h5>
</div>
<div id="main" onclick="w3_close()">
    

    <div class="header-container">
        <div class="burgericon">
        <button id="openNav" class="w3-button w3-xlarge " onclick="w3_open(event)">&#9776;</button>
    </div>
        <div class="w3-container">
            <h1>Section Information</h1>
        </div>
    </div>
        @if ($errors->any())
        <div class="alert" id="error-alert">
            <span>Error(s) occurred:</span>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            // Set a timeout to hide the error alert after 2 seconds
            setTimeout(() => {
                const alert = document.getElementById('error-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 2000);
        </script>
        @endif
            <div class="container">
        <div class="form-section">
            <h2>Create Section & Schedule</h2>
            <form action="/createsection" method="POST">
                @csrf
                <label for="grade">Grade:</label>
                <select class="form-control" id="grade" name="grade" required onchange="updateSections()">
                    <option value="">Select Grade</option>
                    <option value="K">Kindergarten</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="Grade {{ $i }}">Grade {{ $i }}</option>
                    @endfor
                </select>

                <div class="col">
                    <label for="section">Section</label>
                    <select class="form-control" id="section" name="section" required onchange="handleSectionChange()">
                        <option value="">Select Section</option>
                    </select>
                </div>

                <button type="submit">Proceed to add schedules</button>
            </form>
        </div>

        <div class="table-section">
            <h2>Existing Sections</h2>
            <table>
                <thead>
                    <tr>
                        <th>Grade</th>
                        <th>Section</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                        <tr>
                            <td>{{ $section->grade }}</td>
                            <td>{{ $section->section }}</td>
                            <td>
                                <a href="{{ route('principalclassload', ['grade' => $section->grade, 'section' => $section->section]) }}" class="icon-button" title="Edit Schedule">&#9998;</a>
                                <form action="{{ route('section.delete', $section->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this section?');" class="icon-button" title="Delete Section">&#10060;</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
        </div>

@include('templates.principalfooter')

<script>
    const sectionsByGrade = {
        'K': ["Faith"],
        'Grade 1': ["Joy"],
        'Grade 2': ["Love"],
        'Grade 3': ["Peace"],
        'Grade 4': ["Charity"],
        'Grade 5': ["Hope"],
        'Grade 6': ["Respect"],
        'Grade 7': ["Emerald", "Diamond", "Gold", "Sapphire"],
        'Grade 8': ["Emerald", "Gold", "Sapphire"],
        'Grade 9': ["Emerald", "Diamond", "Gold", "Sapphire"],
        'Grade 10': ["Emerald", "Diamond", "Ruby", "Sapphire", "Gold"]
    };

    function updateSections() {
        const grade = document.getElementById('grade').value;
        const sectionSelect = document.getElementById('section');
        sectionSelect.innerHTML = '<option value="">Select Section</option>'; // Reset options

        if (sectionsByGrade[grade]) {
            sectionsByGrade[grade].forEach(section => {
                const option = document.createElement('option');
                option.value = section;
                option.textContent = section;
                sectionSelect.appendChild(option);
            });
            // Add option to add a new section
            const addOption = document.createElement('option');
            addOption.value = 'add';
            addOption.textContent = 'Add New Section';
            sectionSelect.appendChild(addOption);
        }
    }

    function handleSectionChange() {
        const sectionSelect = document.getElementById('section');
        if (sectionSelect.value === 'add') {
            const grade = document.getElementById('grade').value;
            const newSection = prompt("Enter new section name:");

            if (newSection && grade) {
                if (!sectionsByGrade[grade].includes(newSection)) {
                    sectionsByGrade[grade].push(newSection);
                    updateSections();
                    sectionSelect.value = newSection; // Select the newly added section
                    alert("Section added successfully!");
                } else {
                    alert("Section already exists for this grade.");
                }
            } else {
                alert("Please select a grade first.");
            }
        }
    }
    function w3_open(event) {
            event.stopPropagation();
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("main").style.marginLeft = "220px";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("main").style.marginLeft = "0";
        }
</script>
    </body>
    </html>