<div>
    @if($faq_data)
        <section class="faq">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2>Frequently Asked Questions</h2>
                        <div class="accordion" id="faqAccordion"> 
                            @foreach($faq_data as $item => $value)
                     
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="{{$item-1}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#item-{{$item}}" aria-expanded="false" aria-controls="a2">
                                        {{$value->faq_question}}
                                    </button>
                                </h3>
                                <div id="item-{{$item}}" class="accordion-collapse collapse" aria-labelledby="{{$item-1}}"
                                    data-bs-parent="#faqAccordion-">
                                    <div class="accordion-body">
                                        {{$value->faq_answer}}
                                    </div>
                                </div>
                            </div>
                           
                            @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
     <!-- FAQ Section -->
     <!-- <section class="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>Frequently Asked Questions</h2>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a1" aria-expanded="true" aria-controls="a1">
                                    Bachelor of Science in Computer Science 
                                </button>
                            </h3>
                            <div id="a1" class="accordion-collapse collapse show" aria-labelledby="q1"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                Computer Science is the study of computers and computational systems. Unlike electrical and computer engineers, computer scientists deal mostly with software ..
                                </div>
                            </div>
                        </div>
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
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a3" aria-expanded="false" aria-controls="a3">
                                    Do I need to make an appointment for all services provided by the Testing and Evaluation Center?
                                </button>
                            </h3>
                            <div id="a3" class="accordion-collapse collapse" aria-labelledby="q3"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Appointments are typically required for most services. However, for certain walk-in services or events, appointments may not be necessary. We recommend checking the specific service details or contacting us for more information.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q4">
                                <button class="accordion-button collapsed" type of button" data-bs-toggle="collapse"
                                    data-bs-target="#a4" aria-expanded="false" aria-controls="a4">
                                    How long does it take to receive the results of an evaluation or assessment?
                                </button>
                            </h3>
                            <div id="a4" class="accordion-collapse collapse" aria-labelledby="q4"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The time it takes to receive evaluation or assessment results may vary depending on the type of service. Typically, we strive to provide results within a reasonable time frame. Specific details on result delivery can be found on the respective service pages or by contacting our center directly.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a5" aria-expanded="false" aria-controls="a5">
                                    Are there any fees associated with the services offered by the Testing and Evaluation Center?
                                </button>
                            </h3>
                            <div id="a5" class="accordion-collapse collapse" aria-labelledby="q5"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Some of our services may have associated fees, while others are provided free of charge. We encourage you to review the pricing details on our website or contact us to inquire about the specific service fees and any applicable waivers.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a6" aria-expanded="false" aria-controls="a6">
                                    How can I request a copy of my evaluation or assessment report?
                                </button>
                            </h3>
                            <div id="a6" class="accordion-collapse collapse" aria-labelledby="q6"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can request a copy of your evaluation or assessment report by contacting our center directly. We will provide guidance on the process and any associated fees, if applicable, for obtaining a copy of your report.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a7" aria-expanded="false" aria-controls="a7">
                                    Can I reschedule or cancel my appointment with the Testing and Evaluation Center?
                                </button>
                            </h3>
                            <div id="a7" class="accordion-collapse collapse" aria-labelledby="q7"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, you can reschedule or cancel your appointment with advance notice. Please visit our <a href="appointment.php">Appointment page</a> for instructions on how to reschedule or cancel your appointment.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q8">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a8" aria-expanded="false" aria-controls="a8">
                                    What is the typical duration of a college entrance exam evaluation?
                                </button>
                            </h3>
                            <div id="a8" class="accordion-collapse collapse" aria-labelledby="q8"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The duration of a college entrance exam evaluation may vary depending on the specific test and the number of sections. Typically, it takes a few hours, but exact timing will be provided when you schedule your appointment.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q9">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a9" aria-expanded="false" aria-controls="a9">
                                    Are there any preparation materials available for the entrance exams?
                                </button>
                            </h3>
                            <div id="a9" class="accordion-collapse collapse" aria-labelledby="q9"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we provide preparation materials and study guides for our entrance exams. You can find these resources on our website or request them when you schedule your exam.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q10">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a10" aria-expanded="false" aria-controls="a10">
                                    What types of payment methods are accepted for service fees?
                                </button>
                            </h3>
                            <div id="a10" class="accordion-collapse collapse" aria-labelledby="q10"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We accept various payment methods, including credit cards, debit cards, and cash. Specific payment options and details will be provided when you book your service.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q11">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a11" aria-expanded="false" aria-controls="a11">
                                    How can I check the availability of assessment dates and times?
                                </button>
                            </h3>
                            <div id="a11" class="accordion-collapse collapse" aria-labelledby="q11"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can check the availability of assessment dates and times by visiting our website or contacting our center directly. We provide information on upcoming assessment schedules.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q12">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a12" aria-expanded="false" aria-controls="a12">
                                    What do I need to bring with me when I come for an assessment?
                                </button>
                            </h3>
                            <div id="a12" class="accordion-collapse collapse" aria-labelledby="q12"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The requirements for each assessment may vary. You will receive specific instructions when you schedule your assessment. Generally, you may need to bring identification, proof of payment, and any required materials, such as pencils or calculators.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q13">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a13" aria-expanded="false" aria-controls="a13">
                                    How do I access my assessment results online?
                                </button>
                            </h3>
                            <div id="a13" class="accordion-collapse collapse" aria-labelledby="q13"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We provide online access to assessment results through our secure portal. You will receive login information and instructions on how to access your results after completing your assessment.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q14">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a14" aria-expanded="false" aria-controls="a14">
                                    What should I do if I encounter technical issues during an online assessment?
                                </button>
                            </h3>
                            <div id="a14" class="accordion-collapse collapse" aria-labelledby="q14"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    If you experience technical difficulties during an online assessment, please contact our technical support team immediately. We will assist you in resolving the issues to ensure a smooth assessment process.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q15">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a15" aria-expanded="false" aria-controls="a15">
                                    How can I provide feedback or suggestions about your services?
                                </button>
                            </h3>
                            <div id="a15" class="accordion-collapse collapse" aria-labelledby="q15"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We welcome your feedback and suggestions. You can provide feedback by contacting our customer service team, or by using the feedback forms available on our website. Your input helps us improve our services.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q16">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a16" aria-expanded="false" aria-controls="a16">
                                    Can I request a refund if I need to cancel my assessment appointment?
                                </button>
                            </h3>
                            <div id="a16" class="accordion-collapse collapse" aria-labelledby="q16"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our refund policy may vary depending on the type of assessment and the timing of your cancellation. Please review our refund policy on our website or contact us for detailed information regarding refunds.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q17">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a17" aria-expanded="false" aria-controls="a17">
                                    What security measures are in place to protect my personal information during assessments?
                                </button>
                            </h3>
                            <div id="a17" class="accordion-collapse collapse" aria-labelledby="q17"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We take data security seriously and have robust measures in place to protect your personal information during assessments. These measures may include encryption, secure servers, and privacy policies to safeguard your data. Specific details can be found on our website.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q18">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a18" aria-expanded="false" aria-controls="a18">
                                    Do you offer practice assessments or study materials for preparation?
                                </button>
                            </h3>
                            <div id="a18" class="accordion-collapse collapse" aria-labelledby="q18"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we may offer practice assessments and study materials to help you prepare for your evaluation. You can find information on available resources on our website or by contacting us.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q19">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a19" aria-expanded="false" aria-controls="a19">
                                    Can I request a copy of my assessment or evaluation for my records?
                                </button>
                            </h3>
                            <div id="a19" class="accordion-collapse collapse" aria-labelledby="q19"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can request a copy of your assessment or evaluation for your records. Please contact our center to initiate the request, and we will provide information on the process and any associated fees.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="q20">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a20" aria-expanded="false" aria-controls="a20">
                                    Are there any age restrictions for taking assessments at the Testing and Evaluation Center?
                                </button>
                            </h3>
                            <div id="a20" class="accordion-collapse collapse" aria-labelledby="q20"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We may have specific age requirements for certain assessments. These requirements can vary by assessment type. Please review the assessment details on our website or contact us for age-related information.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- FAQ Section -->
</div>
