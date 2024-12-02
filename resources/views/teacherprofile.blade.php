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

    .card {
        border-radius: 15px;
    }

    .img-fluid {
        width: 100px;
    }
    h1{
        font-size:24px;
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
            <h1 style="margin: 0;">Teacher Profile</h1>
        </div>
    </div>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-xl-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="mt-3 mb-4">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                                    class="rounded-circle img-fluid" />
                            </div>
                            <h4 class="mb-2">Claire Mae. Hear</h4>
                            <p class="text-muted mb-4">Elementary Teacher <span class="mx-2">|</span> <a
                                    href="#!">Teacherclaire@gmail.com</a></p>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-rounded btn-lg">
                                Edit
                            </button>
                            <div class="d-flex justify-content-between text-center mt-5 mb-2">
                                <div>
                                    <p class="mb-2 h5">5</p>
                                    <p class="text-muted mb-0">Total Class</p>
                                </div>
                                <div class="px-3">
                                    <p class="mb-2 h5">168</p>
                                    <p class="text-muted mb-0">Total Student</p>
                                </div>
                                <div>
                                    <p class="mb-2 h5">092343424</p>
                                    <p class="text-muted mb-0">Contact Details</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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