@include('templates.recordheader')

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

    .w3-teal {
        background-color: #0c3b6d; 
    }

    h1 {
        margin: 0; 
        font-size: 20px;
    }

    .w3-sidebar {
        background-color: #0c3b6d; 
        color: white;
    }

    .w3-bar-item {
        color: white;
        font-size: 16px;
    }

    .w3-bar-item:hover {
        background-color: #0a2e4d; /* Darker shade on hover */
    }

    .container {
        margin: 100px; /* Add margin to container */
        display: flex;
        flex-direction: column;
        align-items: center; /* Center contents */
    }

    .card {
        border-radius: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
        width: 100%; /* Full width for smaller screens */
        max-width: 600px; /* Limit max width */
        margin: 10px 0; /* Add margin for spacing */
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background-color: #0c3b6d; /* Match card header color */
        color: white;
    }

    .list-group-item {
        transition: background-color 0.3s;
    }

    .list-group-item:hover {
        background-color: #e9ecef; /* Light hover effect */
    }

    h1, h5 {
        margin: 0;
    }

    .text-center {
        text-align: center;
    }
</style>

<div id="main">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1 class="text-center">Records Dashboard</h1>
    </div>

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        
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
    </div>

    <div class="container mt-4 mb-5">
        <div class="row">
      
            <div class="col-md-12 mb-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Account Summary</h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="h4">Pending Accounts: <span class="text-warning">{{ $pendingCount }}</span></p>
                        <p class="h4">Approved Accounts: <span class="text-success">{{ $approvedCount }}</span></p>
                    </div>
                </div>
            </div>

            
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

@include('templates.recordfooter')

<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        // Add event listener to close sidebar on outside click
        document.addEventListener('click', outsideClickListener);
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        // Remove the event listener when sidebar is closed
        document.removeEventListener('click', outsideClickListener);
    }

    function outsideClickListener(event) {
        const sidebar = document.getElementById("mySidebar");
        const openButton = document.getElementById("openNav");

        // Check if the click was outside the sidebar and the open button
        if (sidebar.style.display === "block" && !sidebar.contains(event.target) && event.target !== openButton) {
            w3_close();
        }
    }
</script>