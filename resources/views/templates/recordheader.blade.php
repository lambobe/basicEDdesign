<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>RECORD</title>
    <style>
        .w3-sidebar {
            background-color: #0c3b6d; /* Sidebar background color */
            color: white; /* Default text color */
            width: 250px; /* Fixed width */
            transition: width 0.3s; /* Smooth transition for width */
            overflow-y: auto; /* Enable scrolling if content exceeds height */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5); /* Shadow effect for the sidebar */
        }

        .profile-section {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-picture {
            width: 40px; /* Adjust size as needed */
            height: 40px; /* Adjust size as needed */
            border-radius: 50%; /* Circular profile picture */
            margin-right: 10px; /* Space between image and name */
        }

        .profile-name {
            color: white; /* Name text color */
        }

        .w3-bar-item {
            display: flex;
            align-items: center;
            padding: 10px; /* Adjust padding for your design */
            text-decoration: none;
            color: white; /* White text */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
            border-radius: 5px; /* Rounded corners */
        }

        .w3-bar-item svg {
            width: 20px; /* Set a smaller width */
            height: 20px; /* Set a smaller height */
            margin-right: 5px; /* Space between icon and text */
        }

        .w3-bar-item:hover {
            background-color: white; /* Background color on hover */
            color: #007bff; /* Text color on hover */
        }

        .w3-bar-item:hover svg {
            fill: #0800e4; /* Change icon color on hover */
        }
    </style>
</head>

<body>
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <div class="profile-section">
            <img src="image/cler.jpg" alt="Profile Picture" class="profile-picture">
            <span class="profile-name" style="margin-top:-3.5%; font-size: 17px;">{{ auth()->user()->firstname }}</span>
        </div>

        <h5>
            <a href="/record" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check-fill" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                    <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
                </svg> HOME
            </a>
            <a href="/studententries" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                </svg> STUDENTS APPLICANT
            </a>
            <a href="/studentapplicant" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                </svg> PENDING PARTIAL ACCOUNT
            </a>
            <a href="/approvedaccount" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                </svg> APPROVED STUDENTS
            </a>
            <a href="/logout" class="w3-bar-item w3-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                </svg> Logout
            </a>
        </h5>
    </div>
</body>

</html>