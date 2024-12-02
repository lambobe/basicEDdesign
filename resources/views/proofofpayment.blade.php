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
        background-color: #0c3b6d; 
        color: white;
        padding: 10px; 
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

    .payment-proof-image {
        width: 185px;
        display: block;
        margin: 10px 0;
        border: 2px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-control {
        border-color: #ddd;
        border-radius: 4px;
    }

    .btn-primary {
        background-color: #008080;
        border-color: #008080;
    }

    .btn-primary:hover {
        background-color: #006060;
        border-color: #006060;
    }
    h1{
        font-size:24px;
    }
</style>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
    <a href="/principal" class="w3-bar-item w3-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check-fill" viewBox="0 0 16 16">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
            <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
            <path d="m12.5 16 a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514" />
        </svg>
        HOME
    </a>
</div>

<div id="main">
    <div class="header-container">
        <button id="openNav" class="w3-button w3-xlarge nav-button" onclick="w3_open()">&#9776;</button>
        <div class="w3-container" style="margin-left: 15px;">
            <h1>Proof of Payment</h1>
        </div>
    </div>

    <div class="container my-5">
        <h1 class="text-center mb-4">Proof Of Payment</h1>
        <form id="paymentForm" action="/proofofpayment/{{ $proof->id }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" value="{{ $student->firstname }}" readonly required>
                </div>
                <div class="form-group col-md-4">
                    <label for="id-number">ID Number</label>
                    <input type="text" class="form-control" id="id-number" value="12321321" readonly required>
                </div>
                <div class="form-group col-md-4">
                    <label for="grade-level">Grade Level</label>
                    <input type="text" class="form-control" id="grade-level" value="{{ $proof->level }}" readonly required>
                </div>
            </div>

            <div class="form-group">
                <label for="fee-type">Fee Type</label>
                <input type="text" class="form-control" id="fee-type" value="{{ $proof->fee_type }}" readonly required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" value="{{ $proof->amount }}" readonly required>
            </div>

            <div class="form-group">
                <label for="payment-proof">Payment Proof (Image)</label>
                <br>
                <img src="{{ asset('storage/' . $proof->payment_proof) }}" alt="Payment Proof" class="img-fluid"
                    style="max-width: 700px;" id="paymentProofImage" data-toggle="modal" data-target="#imageModal">
            </div>
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel">Payment Proof</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('storage/' . $proof->payment_proof) }}" alt="Payment Proof"
                                class="img-fluid" id="modalImage" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="payment-details">Payment Details</label>
                <textarea class="form-control" id="payment-details" rows="3" required readonly>{{ $proof->payment_details }}</textarea>
            </div>
            <br>

            <div class="row justify-content-center">
                @if ($proof->status === 'pending')
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary btn-block" id="approveButton">Approve</button>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const approveButton = document.getElementById('approveButton');
        const paymentForm = document.getElementById('paymentForm');

        approveButton.addEventListener('click', function(event) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to approve this payment.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    paymentForm.submit();
                }
            });
        });
    });
</script>

@include('templates.cashierfooter')