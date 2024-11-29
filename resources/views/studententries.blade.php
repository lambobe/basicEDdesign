@include('templates.recordheader')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: white; /* Changed for consistency */
        margin: 0;
        padding: 0;
    }

    .header-container {
        display: flex; 
        align-items: center; 
        background-color: #0c3b6d; 
        color: white;
        padding: 15px; 
    }

    .w3-teal {
        background-color: #0c3b6d; /* Match the header color */
    }

    h1 {
        margin: 0; 
        font-size: 20px;
   
    }

    .w3-sidebar {
        background-color: #0c3b6d; 
        color: white;
        width: 250px; /* Set a fixed width for the sidebar */
        position: fixed; /* Make it fixed */
        height: 100%; /* Full height */
        padding-top: 20px; /* Space at the top */
        display: none; /* Initially hidden */
    }

    .w3-bar-item {
        color: white;
        font-size: 16px;
        padding: 10px 15px; /* Add some padding */
    }

    .w3-bar-item:hover {
        background-color: #0a2e4d; /* Darker shade on hover */
    }

    .container {
        margin: 20px auto; /* Center the container */
        max-width: 100%; /* Limit max width */
        padding: 0 15px; /* Add padding */
        margin-left: 5px; /* Leave space for the sidebar */
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        margin-bottom: 15px; /* Space below the input */
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
    }

    .table th,
    .table td {
        padding: 15px;
        text-align: left;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .btn-info {
        background-color: #17a2b8;
        border: none;
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn-info:hover {
        background-color: #138496;
    }
</style>

<div id="main">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1>Student Entries</h1>
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

    <div class="container">
        <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search for names.."
            class="form-control">

        <table class="table table-striped table-bordered" id="studentTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentDetails as $student)
                    <tr>
                        <td>{{ $student->firstname }}</td>
                        <td>{{ $student->middlename }}</td>
                        <td>{{ $student->lastname }}</td>
                        <td>
                            <a href="/showdetails/{{ $student->id }}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }

    function searchFunction() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('studentTable');
        const tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            const td1 = tr[i].getElementsByTagName('td')[0];
            const td2 = tr[i].getElementsByTagName('td')[1];
            const td3 = tr[i].getElementsByTagName('td')[2];

            if (td1 || td2 || td3) {
                const txtValue1 = td1.textContent || td1.innerText;
                const txtValue2 = td2.textContent || td2.innerText;
                const txtValue3 = td3.textContent || td3.innerText;

                if (txtValue1.toLowerCase().indexOf(filter) > -1 ||
                    txtValue2.toLowerCase().indexOf(filter) > -1 ||
                    txtValue3.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

@include('templates.recordfooter')