<!DOCTYPE html>
<html>

<head>
    <title>Required Documents Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        .upload-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .file-input {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .file-input label {
            display: inline-block;
            font-weight: bold;
            margin-right: 10px;
            width: 150px;
        }

        .file-input select {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 200px;
            margin-right: 10px;
        }

        .file-input input[type="file"] {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 300px;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-left: 10px;
        }

        .submit-button {
            display: block;
            margin: 20px 0 0 0;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        #additional-uploads {
            margin-top: 20px;
        }

        #additional-uploads .file-input {
            margin-bottom: 10px;
        }

        .add-upload-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
        }

        .btn-upload {
            display: inline-block;
            margin-left: 10px;
        }
    </style>
</head>



<body>
    <div class="upload-container">
        <h2>Required Documents Upload</h2>
        <p>Scanned copies must be clear and legible. Each file must not exceed 10MB.</p>
        <p>Accepted file formats for 2x2 ID Picture are jpg/png; all documents should be in pdf format.</p>
        <p>If your NSO / PSA Birth Certificate original copy is not clear/legible, you are required to upload a Local
            Civil Registrar (LCR).</p>
        <p>If you have an ESC Grantee Certificate, please include it in your uploads.</p>
        <p>2x2 ID Picture</p>
        <p>Please upload at least one (1) document.</p>

        <form action="/updatedocuments" method="POST" enctype="multipart/form-data">
            @csrf <!-- Include this line for CSRF protection in Laravel -->
            <div class="file-input">
                <label for="document-type">Select Document Type</label>
                <input type="text" name="type" id="document-type" value="{{ $docs->type ?? '' }}" required>

                <div class="col-md-6 mt-3">
                    @if ($docs && $docs->documents)
                        @php
                            $imagePath = asset('documents/' . $docs->documents);
                        @endphp
                        <img src="{{ $imagePath }}" alt="Uploaded Document" class="img-fluid rounded"
                            onerror="this.style.display='none';">
                        <p>Image Path: {{ $imagePath }}</p> <!-- Debug line -->
                    @else
                        <img src="https://via.placeholder.com/640x480.png/003366?text=No+Image" alt="No Image Available"
                            class="img-fluid rounded">
                    @endif
                </div>

                <div class="error-message" id="file-error"></div>
            </div>

            <input type="hidden" id="required_id" name="required_id" value="{{ auth()->user()->id }}">

            <div id="additional-uploads"></div>

            <button type="button" class="add-upload-button" onclick="addAnotherUpload()">Add Another Upload</button>
            <button type="submit" name="submit" class="btn btn-success" onclick="validateAndSubmit()">Upload</button>
        </form>
    </div>

    <script>
        function validateAndSubmit() {
            const form = document.querySelector('form');
            const formData = new FormData(form);
            const fileError = document.getElementById('file-error');
            fileError.textContent = '';

            // Check if at least one file is selected
            if (formData.getAll('documents').length === 0) {
                fileError.textContent = 'Please select at least one file to upload.';
                return;
            }

            // Check if document type is selected
            if (!formData.get('type')) {
                fileError.textContent = 'Please select a document type.';
                return;
            }

            // Submit the form using AJAX
            fetch('/updatedocuments', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Laravel CSRF token
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err.errors; // Handle validation errors
                        });
                    }
                    return response.json(); // Return the JSON response
                })
                .then(data => {
                    alert(data.message); // Success message
                    form.reset(); // Reset the form
                    document.getElementById('additional-uploads').innerHTML = ''; // Clear additional uploads
                })
                .catch(errors => {
                    // Display validation errors
                    for (let key in errors) {
                        fileError.textContent += errors[key].join(', ') + ' ';
                    }
                });
        }

        function addAnotherUpload() {
            const additionalUploads = document.getElementById('additional-uploads');
            const newUpload = document.createElement('div');
            newUpload.className = 'file-input mt-3';

            const label = document.createElement('label');
            label.textContent = 'Select Document';
            newUpload.appendChild(label);

            const select = document.createElement('select');
            select.name = 'type[]'; // Use array syntax for multiple types
            select.required = true;
            select.innerHTML = `
                <option value="" disabled selected>Select document type</option>
                <option value="2x2 ID Picture">2x2 ID Picture</option>
                <option value="Birth Certificate">Birth Certificate</option>
                <option value="LCR">Local Civil Registrar (LCR)</option>
                <option value="ESC Grantee Certificate">ESC Grantee Certificate</option>
                <option value="Other">Other</option>
            `;
            newUpload.appendChild(select);

            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'documents[]'; // Use array syntax for multiple uploads
            fileInput.accept = '.pdf,.jpg,.png';
            fileInput.required = true;
            newUpload.appendChild(fileInput);

            const errorMessage = document.createElement('div');
            errorMessage.className = 'error-message';
            newUpload.appendChild(errorMessage);

            additionalUploads.appendChild(newUpload);
        }
    </script>
</body>

</html>