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

    h2 {
        color: #00796b; /* Teal color for section heading */
        margin-top: 20px; /* Margin above section heading */
        margin-bottom: 15px; /* Margin below section heading */
    }

    .table {
        width: 100%; /* Full width for table */
        margin: 20px 0; /* Margin above and below table */
        border-radius: 8px; /* Rounded corners for table */
        overflow: hidden; /* Hide overflow for rounded corners */
    }

    .table th {
        background-color: #0c3b6d; /* Header background color */
        color: white; /* Header text color */
        text-align: center; /* Center header text */
    }

    .table td {
        text-align: center; /* Center table data */
    }

    .btn {
        padding: 10px 15px; /* Increased button padding */
        border-radius: 5px; /* Rounded corners for buttons */
        transition: background-color 0.3s; /* Smooth transition for hover effect */
    }

    .btn-primary {
        background-color: #00796b; /* Primary button color */
        color: white; /* Primary button text color */
    }

    .btn-primary:hover {
        background-color: #005f56; /* Darker shade on hover */
    }

    .btn-secondary {
        background-color: #6c757d; /* Secondary button color */
        color: white; /* Secondary button text color */
    }

    .btn-secondary:hover {
        background-color: #5a6268; /* Darker shade on hover */
    }

    @media (max-width: 768px) {
        .header-container h1 {
            font-size: 20px; /* Adjust font size for mobile */
        }
    }
</style>

<div id="main">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
        <h1>Assessments Overview</h1>
    </div>

    <div class="row mb-3">
        <div class="col">
            <h2>List of Created Assessments</h2>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>School Year</th>
                <th>Grade Level</th>
                <th>Assessment Name</th>
                <th>Description</th>
                <th>Assessment Date</th>
                <th>Assessment Time</th>
                <th>Assessment Fee</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assessments as $assessment)
                <tr>
                    <td>{{ $assessment->school_year }}</td>
                    <td>{{ $assessment->grade_level }}</td>
                    <td>{{ $assessment->assessment_name }}</td>
                    <td>{{ $assessment->description }}</td>
                    <td>{{ $assessment->assessment_date }}</td>
                    <td>{{ $assessment->assessment_time }}</td>
                    <td>{{ $assessment->assessment_fee }}</td>
                    <td>{{ $assessment->status }}</td>
                    <td>
                        <form action="{{ route('assessment.publish', $assessment->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </form>
                        <form action="{{ route('assessment.edit', $assessment->id) }}" method="GET" class="d-inline">
                            <button type="submit" class="btn btn-secondary">Edit</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No assessments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('templates.principalfooter')