@include('templates.principalheader')

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
        background-color: #0c3b6d; 
        color: white;
        padding: 15px; 
    }

    .w3-teal {
        background-color: #0c3b6d; /* Match header color */
    }

    h1 {
        margin: 0; 
        font-size: 20px;
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
        max-width: 80%; /* Limit max width */
        padding: 20px; /* Padding inside the container */
        border: 1px solid #ccc; /* Border styling */
        border-radius: 8px; /* Rounded corners */
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        margin-bottom: 15px; /* Space below input */
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

    .btn-outline-secondary {
        border: 1px solid #ced4da;
        color: #495057;
    }

    .btn-outline-secondary:hover {
        background-color: #e2e6ea;
    }
</style>

<div id="main">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1>Sectioning</h1>
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
        <form action="/sectioning" method="GET">
            @csrf
            <div class="fee-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex">
                        <div class="input-group mr-3">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search"
                                name="search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Refresh Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Grade Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                @php
                                    // Get the payment associated with the student
                                    $payment = $payments->firstWhere('payment_id', $student->id);
                                    $status = $payment ? $payment->status : 'No payment';
                                @endphp
                            
                                @if ($status === 'approved')
                                    <!-- Only show approved students -->
                                    <tr>
                                        <td>{{ $status }}</td>
                                        <td>{{ $student->lastname }}</td>
                                        <td>{{ $student->firstname }}</td>
                                        <td>{{ $student->middlename }}</td>
                                        <td>
                                            {{ $payment->level ?? 'N/A' }}
                                        </td>
                                        <td>
                                            @if ($payment)
                                                <a href="/assigning/{{ $student->id }}"
                                                    class="btn btn-info btn-sm view-studententry" title="View">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M7.998 2c-2.757 0-5.287 1.417-6.758 3.75a.748.748 0 0 0 0 .5c1.471 2.333 4.001 3.75 6.758 3.75s5.287-1.417 6.758-3.75a.748.748 0 0 0 0-.5c-1.471-2.333-4.001-3.75-6.758-3.75zm0 1.5a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5zm0 2a1.75 1.75 0 1 0 0 3.5 1.75 1.75 0 0 0 0-3.5z" />
                                                    </svg>
                                                </a>
                                            @else
                                                <span>No payment found</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
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

@include('templates.principalfooter')