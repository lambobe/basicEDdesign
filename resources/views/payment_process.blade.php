<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #0c3b6d;
            font-weight: bold;
        }

        .form-group label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #0c3b6d;
            border-color: #007bff;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        textarea {
            resize: none;
        }

        .custom-file-label::after {
            content: "Browse";
            background-color: #0c3b6d;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Payment Form</h1>
        <form action="/payment_process" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="fee-type">Fee Type</label>
                <input type="text" class="form-control" id="fee-type" name="fee_type" value="Enrollment Fee"
                    readonly required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="500" readonly
                    required>
            </div>
            <div class="form-group mt-3">
                <label for="level">Year Level</label>
                <select class="form-control" id="level" name="level" required>
                    <option value="">Select Grade</option>
                    <option value="K">Kindergarten</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="Grade {{ $i }}">Grade {{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="payment-proof">Payment Proof (Image)</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="payment-proof" name="payment-proof"
                        accept="image/*" required>
                    <label class="custom-file-label" for="payment-proof">Choose image file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="payment-details">Payment Details</label>
                <textarea class="form-control" id="payment-details" name="payment-details" rows="3"
                    placeholder="Enter payment details" required></textarea>
            </div>
            <input type="hidden" name="payment_id" value="{{ $registerForm->id }}">
            <button type="submit" class="btn btn-primary btn-block">Submit Payment</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
</body>

</html>