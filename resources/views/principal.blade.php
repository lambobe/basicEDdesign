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
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: white;
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

.header-container h1 {
    margin: 0;
    font-size: 24px;
    flex-grow: 1;
    text-align: center;
}

.dashboard-card {
    z-index: 1;
    background: rgba(8, 16, 66, 1);
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin: 10px;
    position: relative;
}

/* Increased the scale factor on hover to 1.1 for a more subtle effect */
.dashboard-card:hover {
    transform: scale(1.1);
}

h3 {
    margin: 10px 0;
    color: #00796b;
}

/* Adjusted the margin-top for paragraphs to 8px to provide better spacing */
p {
    color: white;
    margin-top: 8px;
    text-decoration:none;
}
.w3-dashyboard{
    text-decoration:none;
    color:white;
}
.w3-dashyboard h3{
    text-decoration:none;
    font-family:'Arial', sans-serif;
    color:white;
    font-size:24px;
}
.w3-dashyboard svg{
    max-width:400%;
}

@media (max-width: 768px) {
    .dashboard-card {
        margin-bottom: 20px;
    }
}

h1 {
    font-size: 20px;
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
    position:fixed;
    width: 30px;
    border-radius: 0;
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
                align-items: flex-start; /* Align items to the start */
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
</style>
</head>
<body>
        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <div class="profile-section">
            <img src="image/cler.jpg" alt="Profile Picture" class="profile-picture">
            <span class="profile-name" style="text-align:center">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
            <a href="/#">View Profile</a>
        </div>
        <h5>
            <a href="/principal" class="w3-bar-item w3-button active"><svg xmlns="http://www.w3.org/2000/svg" width="16"
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
        <a href="/principalteacher" class="w3-bar-item w3-button"><svg xmlns="http://www.w3.org/2000/svg" width="16"
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
            <a href="/createsection" class="w3-bar-item w3-button"><svg xmlns="http://www.w3.org/2000/svg"
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
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open(event)">&#9776;</button>
        <h1>Principal Dashboard</h1>

    </div>

    <div class="w3-container">
        <div class="w3-row">
            <div class="w3-col s6 m4 l3">
                <div class="dashboard-card">
                    <a href="/principalstudent" class="w3-dashyboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm11-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm-2 3a.5.5 0 0 1 0 1h2a.5.5 0 0 1 0-1zm0 3a.5.5 0 0 1 0 1h2a.5.5 0 0 1 0-1zM24 4a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 24 4z" />
                        </svg>
                        <h3>Students Applicant</h3>
                        <p>View and manage student applications.</p>
                    </a>
                </div>
            </div>
            <div class="w3-col s6 m4 l3">
                <div class="dashboard-card">
                    <a href="/principalclassload" class="w3-dashyboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4" />
                        </svg>
                        <h3>Subjects</h3>
                        <p>Manage and view available subjects.</p>
                    </a>
                </div>
            </div>
            <div class="w3-col s6 m4 l3">
                <div class="dashboard-card">
                    <a href="principalteacher" class="w3-dashyboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1z" />
                        </svg>
                        <h3>Faculty</h3>
                        <p>Manage and view faculty information.</p>
                    </a>
                </div>
            </div>
            <div class="w3-col s6 m4 l3">
                <div class="dashboard-card">
                    <a href="#" class="w3-dashyboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                            <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1z" />
                        </svg>
                        <h3>Department</h3>
                        <p>View and manage department information.</p>
                    </a>
                </div>
            </div>
            <div class="w3-col s6 m4 l3">
                <div class="dashboard-card">
                    <a href="#" class="w3-dashyboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-align-center" viewBox="0 0 16 16">
                            <path d="M8 1a.5.5 0 0 1 .5.5V6h-1V1.5A.5.5 0 0 1 8 1m0 14a.5.5 0 0 1-.5-.5V10h1v4.5a.5.5 0 0 1-.5.5m-4-7a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z" />
                        </svg>
                        <h3>Class</h3>
                        <p>Manage and view class information.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
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
</div>
    </body>
    </html>

