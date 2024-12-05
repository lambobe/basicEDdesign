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
        background-color: rgba(8, 16, 66, 1); 
        color:white;
        padding: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
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

    .table-responsive {
        margin-top: 20px;
    }
    h1{
        font-size:17px;
        font-family:'Arial',sans-serif;
       
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


    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open(event)">&#9776;</button>
        <div class="w3-container" style="margin-left: 15px;">
            <h1 style="margin: 0;">Teacher Attendance</h1>
        </div>
    </div>
    <div id="main" onclick="w3_close()">
    <div class="container my-5">
        <form action="/teacherattendance" method="GET">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">STUDENT ATTENDANCE</h4>
                        <div class="d-flex">
                            <div class="input-group me-3">
                                <input type="text" class="form-control" placeholder="Search by EDP Code..." aria-label="Search" name="search" id="search-input">
                                <button class="btn btn-outline-secondary" type="button" onclick="searchByEdpCode()">Search</button>
                            </div>
                            <button type="button" class="btn btn-outline-secondary" onclick="refreshPage()">Refresh</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="student-table">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Section</th>
                                    <th>Grade Level</th>
                                    <th>Student ID</th>
                                    <th>Edp Code</th>
                                    <th>Subject</th>
                                    <th>1st Quarter Attendance</th>
                                    <th>2nd Quarter Attendance</th>
                                    <th>3rd Quarter Attendance</th>
                                    <th>4th Quarter Attendance</th>
                                    <th>Overall Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Oliver Pacatang</td>
                                    <td>Diamond</td>
                                    <td>Grade 2</td>
                                    <td>2314324</td>
                                    <td>2321</td>
                                    <td>English</td>
                                    <td><input type="text" class="form-control" value="P-23" name="firstquarter"></td>
                                    <td><input type="text" class="form-control" value="P-42" name="secondquarter"></td>
                                    <td><input type="text" class="form-control" value="P-44" name="thirdquarter"></td>
                                    <td><input type="text" class="form-control" value="P-45" name="fourthquarter"></td>
                                    <td><input type="text" class="form-control" value="P-154" name="attendance"></td>
                                </tr>
                                <tr>
                                    <td>Claire Dungog</td>
                                    <td>Diamond</td>
                                    <td>Grade 2</td>
                                    <td>435435</td>
                                    <td>4342</td>
                                    <td>English</td>
                                    <td><input type="text" class="form-control" value="P-45" name="firstquarter"></td>
                                    <td><input type="text" class="form-control" value="P-43" name="secondquarter"></td>
                                    <td><input type="text" class="form-control" value="P-34" name="thirdquarter"></td>
                                    <td><input type="text" class="form-control" value="P-25" name="fourthquarter"></td>
                                    <td><input type="text" class="form-control" value="P-192" name="attendance"></td>
                                </tr>
                                <tr>
                                    <td>Johrnhay Batan</td>
                                    <td>Diamond</td>
                                    <td>Grade 2</td>
                                    <td>2314324</td>
                                    <td>4356</td>
                                    <td>English</td>
                                    <td><input type="text" class="form-control" value="P-32" name="firstquarter"></td>
                                    <td><input type="text" class="form-control" value="P-38" name="secondquarter"></td>
                                    <td><input type="text" class="form-control" value="P-43" name="thirdquarter"></td>
                                    <td><input type="text" class="form-control" value="P-26" name="fourthquarter"></td>
                                    <td><input type="text" class="form-control" value="P-139" name="attendance"></td>
                                </tr>
                                <tr>
                                    <td>Moises Belacura</td>
                                    <td>Diamond</td>
                                    <td>Grade 2</td>
                                    <td>2314324</td>
                                    <td>5657</td>
                                    <td>English</td>
                                    <td><input type="text" class="form-control" value="P-45" name="firstquarter"></td>
                                    <td><input type="text" class="form-control" value="P-56" name="secondquarter"></td>
                                    <td><input type="text" class="form-control" value="P-34" name="thirdquarter"></td>
                                    <td><input type="text" class="form-control" value="P-23" name="fourthquarter"></td>
                                    <td><input type="text" class="form-control" value="P-158" name="attendance"></td>
                                </tr>
                                <tr>
                                    <td>Bernie Lambo</td>
                                    <td>Diamond</td>
                                    <td>Grade 2</td>
                                    <td>2314324</td>
                                    <td>5658</td>
                                    <td>English</td>
                                    <td><input type="text" class="form-control" value="P-32" name="firstquarter"></td>
                                    <td><input type="text" class="form-control" value="P-34" name="secondquarter"></td>
                                    <td><input type="text" class="form-control" value="P-45" name="thirdquarter"></td>
                                    <td><input type="text" class="form-control" value="P-32" name="fourthquarter"></td>
                                    <td><input type="text" class="form-control" value="P-143" name="attendance"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="text-center">
        <a href="#" class="btn btn-danger btn-lg">Save</a>
    </div>

</div>

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

    function searchByEdpCode() {
        var searchInput = document.getElementById("search-input").value.toLowerCase();
        var studentTable = document.getElementById("student-table");
        var rows = studentTable.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) {
            var edpCodeCell = rows[i].getElementsByTagName("td")[4];
            var edpCode = edpCodeCell.textContent.toLowerCase();

            if (edpCode.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    function refreshPage() {
        location.reload();
    }
</script>

@include('templates.teacherfooter')