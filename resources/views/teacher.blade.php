@include('templates.teacherheader')

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
        background-color: #0c3b6d; 
        color: white;
        padding: 10px; 
    }

    .nav-button {
        margin-right: 15px; 
        margin-bottom: 4px;
    }

    h1 {
        margin: 0; 
        font-family: 'Arial', sans-serif;
        font-size: 20px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin: 10px;
        padding: 15px;
        background-color: #f9f9f9;
    }

    .card-title {
        color: #0c3b6d;
        font-size: 18px;
    }

    .card-text {
        color: #555;
        line-height: 1.6;
    }

    .btn {
        background-color: #0c3b6d;
        color: white;
        border: none;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #093d5e;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 20px 0;
    }

    .col-md-6 {
        flex: 0 0 45%; /* Adjusted for responsive design */
        margin: 10px;
    }

    /* Sidebar styles */
    #mySidebar {
        display: none;
        position: fixed;
        z-index: 1;
        height: 100%;
        width: 250px;
        top: 0;
        left: 0;
        background-color: #0c3b6d;
        color: white;
        padding-top: 20px;
        padding-left: 15px;
        transition: 0.3s;
        overflow-y: auto;
    }

    #main {
        transition: margin-left .3s;
        padding: 0px;
    }
</style>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
    <h2>Sidebar</h2>
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Submit Grades</a></li>
        <li><a href="#">View Reports</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#" onclick="w3_close()">Close</a></li>
    </ul>
</div>

<div id="main">
    <div class="header-container"> 
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open(event)">&#9776;</button>
        <h1>Teacher Dashboard</h1>
        <div class="w3-container" style="margin-left: auto;">
            <label>{{ auth()->user()->firstname }}</label>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gradebook</h5>
                    <p class="card-text">Manage and view student grades.</p>
                    <a href="#" class="btn">Open Gradebook</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grade Submitted</h5>
                    <p class="card-text">View and confirm submitted grades.</p>
                    <a href="#" class="btn">View Submissions</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Report</h5>
                    <p class="card-text">Generate reports on student performance.</p>
                    <a href="#" class="btn">Generate Report</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <p class="card-text">View the total number of students.</p>
                    <a href="#" class="btn">View Students</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('templates.teacherfooter')

<script>
    function w3_open(event) {
        event.stopPropagation();
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("main").style.marginLeft = "250px"; // Adjust main content
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("main").style.marginLeft = "0"; // Reset main content
    }
</script>