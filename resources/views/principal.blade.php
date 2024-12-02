@include('templates.principalheader')

<style>
    body {
        background-color: #f4f4f4; /* Consistent background color */
        font-family: Arial, sans-serif; /* Consistent font */
    }

    #main {
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .header-container {
        display: flex;
        align-items: center;
        background-color: #0c3b6d; /* Header background color */
        color: white;
        padding: 10px;
    }

    .header-container h1 {
        margin: 0;
        font-size: 24px; /* Increased font size for visibility */
        flex-grow: 1; /* Allow header to take available space */
        text-align: center; /* Center the header text */
    }

    .w3-container {
        padding: 20px; /* Increased padding for the main container */
    }

    .dashboard-card {
        background: white; /* Card background */
        border-radius: 8px; /* Rounded corners */
        padding: 15px; /* Padding inside cards */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow effect */
        text-align: center; /* Center text inside cards */
        transition: transform 0.2s; /* Animation for hover effect */
    }

    .dashboard-card:hover {
        transform: scale(1.05); /* Slight grow on hover */
    }

    .w3-sidebar {
        background-color: #00796b; /* Sidebar background color */
    }

    .w3-bar-item {
        color: white; /* Sidebar text color */
    }

    .w3-bar-item:hover {
        background-color: #005f56; /* Darker on hover */
    }

    svg {
        display: block; /* Center SVG icons */
        margin: 0 auto 10px; /* Space below the icons */
    }

    h3 {
        margin: 10px 0; /* Space above and below h3 */
        color: #00796b; /* Teal color for headings */
    }

    p {
        color: #555; /* Darker gray for paragraph text */
    }

    @media (max-width: 768px) {
        .dashboard-card {
            margin-bottom: 20px; /* Space between cards on small screens */
        }
    }
    h1{
        font-size:20px;
    }
</style>

<div id="main">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1>Principal Dashboard</h1>
    </div>

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
        <a href="/principal" class="w3-bar-item w3-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-house-check-fill" viewBox="0 0 16 16">
                <path
                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
                <path
                    d="m12.5 16 a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514" />
            </svg>
            HOME
        </a>
        <!-- Other sidebar items -->
    </div>

    <div class="w3-container">
        <div class="w3-row">
            <div class="w3-col s6 m4 l3">
                <div class="dashboard-card">
                    <a href="/principalstudent" class="w3-bar-item w3-button">
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
                    <a href="/principalclassload" class="w3-bar-item w3-button">
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
                    <a href="principalteacher" class="w3-bar-item w3-button">
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
                    <a href="#" class="w3-bar-item w3-button">
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
                    <a href="#" class="w3-bar-item w3-button">
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
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
        }
    </script>
</div>

@include('templates.principalfooter')