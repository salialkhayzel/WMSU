<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WMSU TEC - Services</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    @include('components.navigation');
    <!-- Navigation -->

    <!-- Contact section -->
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Contact Us</h2>
                    <p>If you have any questions, inquiries, or feedback, feel free to contact us using the information
                        below.</p>
                    <ul class="contact-info">
                        <li><i class="bi bi-geo-alt-fill"></i> Address: WMSU Campus, Zamboanga City</li>
                        <li><i class="bi bi-envelope-fill"></i> Email: info@wmsutec.edu</li>
                        <li><i class="bi bi-phone-fill"></i> Phone: (123) 456-7890</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <!-- Contact form -->
                    <form id="contact-form" method="post" action="contact-form-handler.php">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="button3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact section -->


    <!-- Footer -->
    @include('components.footer')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>