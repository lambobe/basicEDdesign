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
    <title>Student Dashboard</title>

    <style>
        .w3-sidebar {
            background-image: url('image/ucbuild.png'); /* Background image */
            background-size: cover; /* Cover the entire sidebar */
            background-position: center; /* Center the image */
            position: relative; /* Required for the pseudo-element */
            color: white; /* Default text color */
            width: 250px; /* Fixed width */
            transition: width 0.3s; /* Smooth transition for width */
            overflow-y: hidden; /* Enable scrolling if content exceeds height */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5); /* Shadow effect for the sidebar */
          
        }
        

        .w3-sidebar::after {
            content: ""; /* Create a pseudo-element */
            position: absolute; /* Position it absolutely */
            top: 0; /* Position at the top */
            left: 0; /* Position at the left */
            right: 0; /* Stretch to the right */
            bottom: 0; /* Stretch to the bottom */
            background-color: rgba(8, 16, 66, 0.9); /* Dark overlay */
            z-index: 1; /* Ensure it sits above the background image */
        }

        .profile-section, .w3-bar-item {
            position: relative; /* Position relative to the sidebar */
            z-index: 2; /* Ensure text items are above the overlay */
        }

        .profile-section {
            display: flex;
            align-items: center;
            padding: 6px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-picture {
            width: 50px; /* Adjust size as needed */
            height: 58px; /* Adjust size as needed */
            border-radius: 80%; /* Circular profile picture */
            margin-right: 20px; /* Space between image and name */
        }

        .profile-name {
            color: white; /* Name text color */
        }

        .w3-bar-item {
            display: flex;
            align-items: center;
            padding: 2px 10px; /* Reduced padding for closer items */
            text-decoration: none;
            color: white; /* White text */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
            border-radius: 5px; /* Rounded corners */
            margin: 0; /* Remove default margin */
        }

        .w3-bar-item svg {
            width: 20px; /* Set a smaller width */
            height: 20px; /* Set a smaller height */
            margin-right: 5px; /* Space between icon and text */
            transition: fill 0.3s; /* Smooth transition for color changes */
        }

        .w3-bar-item:hover {
            background-color: white; /* Background color on hover */
            color: #007bff; /* Text color on hover */
        }

        .w3-bar-item:hover svg {
            fill: black; /* Change icon color on hover */
        }

        .w3-bar-item.w3-button {
            color: rgb(255, 255, 255); /* Text color for close button */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            margin-bottom: 2px; /* Reduced space below the close button */
        }

        .w3-bar-item.w3-button:hover {
            background-color: #0004d6; /* Darker close button on hover */
        }

        .uc-logo-container {
            position: relative; /* Ensure it is positioned correctly */
            z-index: 2; /* Bring logo and text above the overlay */
            text-align: center; /* Center the logo and text */
            margin: 0px 0px; /* Add margin for spacing */
            background-color:rgba(255, 244, 231, 1);
            margin-top:40%;
            padding:12px;
        }

        .uc-logo {
            width: 130px; /* Adjust logo size */
            height: auto; /* Maintain aspect ratio */
            margin-top:5%;
        }

        .uc-text {
            color: black; /* Ensure text is visible */
            font-size: 12px; /* Increase font size for better visibility */
            margin-top: -50px; /* Space between logo and text */
            z-index: 2; /* Ensure text is above overlay */
            position: relative; /* Position context for z-index */
        }
    </style>
</head>

<body>
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <div class="profile-section">
            <img src="image/cler.jpg" alt="Profile Picture" class="profile-picture">
            <span class="profile-name" style="margin-top:-4%; font-size: 15px;">{{ auth()->user()->firstname }}  {{ auth()->user()->lastname }}</span> 
        </div>

        <h5>
            <a href="/oldstudentdashboard" class="w3-bar-item w3-button" id="homeLink">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-house-check-fill" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                    <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514" />
                </svg> Home
            </a>
            <a href="/#" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-video" viewBox="0 0 16 16">
                    <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                    <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm10.798 11c-.453-1.27-1.76-3-4.798-3-3.037 0-4.345 1.73-4.798 3H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1z" />
                </svg> Profile
            </a>
            <a href="/oldstudentclassload" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                </svg> Class Load
            </a>
            <a href="/oldstudentenrollment" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                </svg> Enrollment
            </a>
            <a href="/oldstudentgrades" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-bar-chart-line" viewBox="0 0 16 16">
                    <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1zm1 12h2V2h-2zm-3 0V7H7v7zm-5 0v-3H2v3z"/>
                </svg> Grades
            </a>
            <a href="oldstudentassessment" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1z" />
                </svg> Assessment
            </a>
            <a href="/logout" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                </svg> Logout
            </a>
            <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
            
            <div class="uc-logo-container">
                <img src="image/uclmlogo.png" alt="UC Logo" class="uc-logo">
               
            </div>
        </h5>
    </div>
</body>

</html>