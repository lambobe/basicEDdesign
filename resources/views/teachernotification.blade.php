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

    .notification-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .notification {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 400px;
        overflow: hidden;
    }

    .notification-header {
        display: flex;
        align-items: center;
        padding: 12px;
        background-color: #f0f2f5;
    }

    .profile-picture {
        border-radius: 50%;
        margin-right: 12px;
    }

    .header-text h4 {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
    }

    .header-text p {
        margin: 0;
        font-size: 14px;
        color: #65676b;
    }

    .notification-body {
        padding: 12px;
    }
    h1{
        font-size:24px;
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
</style>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
    <h2>Sidebar</h2>
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Submit Grades</a></li>
        <li><a href="#">View Attendance</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#" onclick="w3_close()">Close</a></li>
    </ul>
</div>

<div id="main">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open()">&#9776;</button>
        <div class="w3-container" style="margin-left: 15px;">
            <h1 style="margin: 0;">Teacher Notification</h1>
        </div>
    </div>

    <div class="notification-container">
        <div class="notification">
            <div class="notification-header">
                <img src="https://via.placeholder.com/40" alt="Profile Picture" class="profile-picture">
                <div class="header-text">
                    <h4>Grade Submission Approved</h4>
                    <p>by Principal</p>
                </div>
            </div>
            <div class="notification-body">
                <p>Your grade submission has been approved by the principal.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("main").style.marginLeft = "250px"; // Adjust main content
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("main").style.marginLeft = "0"; // Reset main content
    }
</script>

@include('templates.teacherfooter')