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

    <!-- FAQ Section -->
    <section class="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>Frequently Asked Questions</h2>
                    <div class="accordion" id="faqAccordion">
                        <!-- Question 1 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a1" aria-expanded="true" aria-controls="a1">
                                    What are the services offered by WMSU Testing and Evaluation Center?
                                </button>
                            </h3>
                            <div id="a1" class="accordion-collapse collapse show" aria-labelledby="q1"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The WMSU Testing and Evaluation Center offers various services including college
                                    entrance exam evaluation, professional development assessments, and research study
                                    evaluations.
                                </div>
                            </div>
                        </div>
                        <!-- Question 2 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a2" aria-expanded="false" aria-controls="a2">
                                    How can I schedule an appointment to visit the center?
                                </button>
                            </h3>
                            <div id="a2" class="accordion-collapse collapse" aria-labelledby="q2"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can schedule an appointment by visiting our <a href="appointment.php">Appointment
                                        page</a> and filling out the appointment form with your details and preferred
                                    date.
                                </div>
                            </div>
                        </div>
                        <!-- Add more questions and answers here -->
                        <!-- ... -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ Section -->


    <!-- Footer -->
    @include('components.footer')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>