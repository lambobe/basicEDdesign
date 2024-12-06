@include('templates.recordheader')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: white; /* Consistent background */
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

    .w3-teal {
        background-color: #0c3b6d; /* Match header color */
    }

    h1 {
        margin: 0; 
        font-size: 17px;
    }

    .w3-sidebar {
        background-color: #0c3b6d; 
        color: white;
        width: 250px; /* Fixed width for sidebar */
        position: fixed; /* Fixed position */
        height: 100%; /* Full height */
        padding-top: 20px; /* Space at the top */
        display: none; /* Initially hidden */
    }

    .w3-bar-item {
        color: white;
        font-size: 16px;
        padding: 10px 15px; /* Padding for items */
    }

    .w3-bar-item:hover {
        background-color: #0a2e4d; /* Darker shade on hover */
    }

    .container {
        margin: 20px auto; /* Center the container */
        max-width: 100%; /* Limit max width */
        padding: 0 15px; /* Add padding */
        margin-left: 5px; /* Space for sidebar */
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        margin-bottom: 15px; /* Space below input */
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div id="main">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1>ACCOUNT APPROVAL</h1>
    </div>

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" id="mySidebar">
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
    </div>

    <div class="account-details">
        <br>

        <form action="/recordapproval" method="POST">
            @csrf
            <div class="container">
                <input type="hidden" name="id" id="id" value="{{ $account->id }}">
                <div class="row mb-3">
                    <div class="col">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname"
                            value="{{ $account->firstname }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname"
                            value="{{ $account->lastname }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="middlename" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middlename" name="middlename"
                            value="{{ $account->middlename }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="suffix" class="form-label">Suffix</label>
                        <input type="text" class="form-control" id="suffix" name="suffix"
                            value="{{ $account->suffix }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $account->email }}" readonly>
                    </div>
                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password"
                            value="{{ $account->password }}" readonly>
                    </div>
                </div>

                <div class="row md-3">
                    <input type="hidden" id="role" name="role" value="Newstudent">
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary">Approve</button>
            </div>

        </form>
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

@include('templates.recordfooter')