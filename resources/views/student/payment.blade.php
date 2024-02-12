<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

@include('student-components.student-navigation')

<section class="payment-section">
        <div class="container">
            <h2 class="section-title">Payment</h2>
            <div class="payment-details">
                <p>To complete your examination registration, please make the payment for the examination permit at the university cashier's office.</p>
                <p>After making the payment, please upload the payment receipt below:</p>
                <form enctype="multipart/form-data" action="{{ url('submit_payment') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="payment_receipt">Upload Receipt:</label>
                        <input type="file" id="payment_receipt" name="payment_receipt" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                </form>
            </div>
        </div>
    </section>


<!-- Include Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
