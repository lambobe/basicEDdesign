@include('templates.cashierheader')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
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

    .card {
        border-radius: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .list-group-item {
        transition: background-color 0.3s;
    }

    .list-group-item:hover {
        background-color: #e9ecef;
    }

    h1, h5 {
        margin: 0;
    }

    .text-center {
        text-align: center;
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
    h1{
        font-size:17px;
        font-family: 'Arial', sans-serif;
    }
</style>




    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open()">&#9776;</button>
        <div class="w3-container" style="margin-left: 15px;">
            <h1 class="text-center">Cashier Dashboard</h1>
        </div>
    </div>
    <div id="main" onclick="w3_close()">
    <div class="container mt-4 mb-5">
        <div class="row">
            <!-- Account Summary Card -->
            <div class="col-md-12 mb-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Payment Summary</h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="h4">Pending Payment: <span class="text-warning">{{ $pendingCount }}</span></p>
                        <p class="h4">Approved Payment: <span class="text-success">{{ $approvedCount }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Student Information Card -->
            <div class="col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Student Information</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($students as $student)
                                <li class="list-group-item">{{ $student->firstname }} {{ $student->lastname }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
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

@include('templates.cashierfooter')