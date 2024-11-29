@include('templates.principalheader')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa; /* Light background */
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

    
    .burger-icon {
    margin-right: 15px;
    width: 36px; 
    height: 36px;
    padding: 0; 
    display: flex;
    align-items: center; 
    justify-content: center;
    background: transparent; 
    border: none;
}

    .header-title {
        font-size: 24px; /* Larger font for the title */
    }

    .container {
        max-width: 1000px;
        margin: auto;
        padding: 2px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
        text-align: left;
        color: #2c3e50;
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
        font-size:20px;
    }

    .form-section, .table-section {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 2px; /* Space between sections */
    }

    input, textarea, select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        width: 30%;
        padding: 10px;
        background-color: #0c3b6d;
        color: white;
        border: none;
        border-radius: 10px;
        transition: background-color 0.3s;
        
        
        
    }

    button:hover {
        background-color: #3f43b9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    th {
        background-color: #17a2b8;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .icon-button {
        background: none;
        border: none;
        cursor: pointer;
        color: #007bff;
        font-size: 24px;
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .icon-button:hover {
        color: #0056b3;
    }

    .alert {
        background-color: #f8d7da; 
        color: #721c24; 
        padding: 15px;
        border: 1px solid #f5c6cb; 
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>

<div id="main">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge burger-icon" onclick="w3_open()">&#9776;</button>
        <div class="header-title">Creating Section</div>
    </div>
    <br><br>

    <div class="container">
        @if ($errors->any())
        <div class="alert" id="error-alert">
            <span>Error(s) occurred:</span>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('error-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 2000);
        </script>
        @endif

        <div class="container" style="display: flex;">
    <div class="form-section" style="flex: 1; margin-right: 20px;">
        <h2>Create Section & Schedule</h2>
        <form action="/createsection" method="POST" style="display: flex; flex-direction: column;">
            @csrf
            <label for="grade">Grade:</label>
            <select class="form-control" id="grade" name="grade" required onchange="updateSections()">
                <option value="">Select Grade</option>
                <option value="K">Kindergarten</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="Grade {{ $i }}">Grade {{ $i }}</option>
                @endfor
            </select>

            <label for="section">Section</label>
            <select class="form-control" id="section" name="section" required onchange="handleSectionChange()">
                <option value="">Select Section</option>
            </select>

            <div style="display: flex; justify-content: flex-end; margin-top: 5px;">
                <button type="submit">Add schedules</button>
            </div>
        </form>
    </div>

    <div class="table-section" style="flex: 1;">
        <h2>Existing Sections</h2>
        <table>
            <thead>
                <tr>
                    <th>Grade</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td>{{ $section->grade }}</td>
                        <td>{{ $section->section }}</td>
                        <td>
                            <a href="{{ route('principalclassload', ['grade' => $section->grade, 'section' => $section->section]) }}" class="icon-button" title="Edit Schedule">&#9998;</a>
                            <form action="{{ route('section.delete', $section->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this section?');" class="icon-button" title="Delete Section">&#10060;</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('templates.principalfooter')

<script>
    const sectionsByGrade = {
        'K': ["Faith"],
        'Grade 1': ["Joy"],
        'Grade 2': ["Love"],
        'Grade 3': ["Peace"],
        'Grade 4': ["Charity"],
        'Grade 5': ["Hope"],
        'Grade 6': ["Respect"],
        'Grade 7': ["Emerald", "Diamond", "Gold", "Sapphire"],
        'Grade 8': ["Emerald", "Gold", "Sapphire"],
        'Grade 9': ["Emerald", "Diamond", "Gold", "Sapphire"],
        'Grade 10': ["Emerald", "Diamond", "Ruby", "Sapphire", "Gold"]
    };

    function updateSections() {
        const grade = document.getElementById('grade').value;
        const sectionSelect = document.getElementById('section');
        sectionSelect.innerHTML = '<option value="">Select Section</option>'; // Reset options

        if (sectionsByGrade[grade]) {
            sectionsByGrade[grade].forEach(section => {
                const option = document.createElement('option');
                option.value = section;
                option.textContent = section;
                sectionSelect.appendChild(option);
            });
            const addOption = document.createElement('option');
            addOption.value = 'add';
            addOption.textContent = 'Add New Section';
            sectionSelect.appendChild(addOption);
        }
    }

    function handleSectionChange() {
        const sectionSelect = document.getElementById('section');
        if (sectionSelect.value === 'add') {
            const grade = document.getElementById('grade').value;
            const newSection = prompt("Enter new section name:");

            if (newSection && grade) {
                if (!sectionsByGrade[grade].includes(newSection)) {
                    sectionsByGrade[grade].push(newSection);
                    updateSections();
                    sectionSelect.value = newSection; // Select the newly added section
                    alert("Section added successfully!");
                } else {
                    alert("Section already exists for this grade.");
                }
            } else {
                alert("Please select a grade first.");
            }
        }
    }
</script>