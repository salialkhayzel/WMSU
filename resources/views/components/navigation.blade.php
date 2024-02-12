<!-- Navigation homepage-->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #990000;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo/logo.png') }}" width="50px" alt="#">
            </a>
            <a class="navbar-brand nav-linklogo" href="{{ route('home') }}">Testing and Evaluation Center</a>
            <!-- Navigation toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navigation links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('appointment') }}">Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="admissionDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Test Application</a>
                        <div class="dropdown-menu" aria-labelledby="admissionDropdown" id="examDropdown">
                            <!-- Dropdown items will be added here dynamically -->
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Navigation homepage -->

<!-- Dropdown items will be added here dynamically -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="admissionDropdown" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">Test Application</a>
    <div class="dropdown-menu" aria-labelledby="admissionDropdown" id="examDropdown">
        <!-- Dropdown items will be added here dynamically -->
    </div>
</li>

<script>
    document.addEventListener("DOMContentLoaded", function () {
  
        const exams = [
            { name: "CET", route: "{{ Route('test-application.Cet') }}" },
            { name: "NAT", route: "{{ Route('test-application.Nat') }}" },
            { name: "EAT", route: "{{ Route('test-application.Eat') }}" },
            { name: "GSAT", route: "{{ Route('test-application.Gsat') }}" },
            { name: "LSAT", route: "{{ Route('test-application.Lsat') }}" },
            // Add more exams as needed
        ];

        const examDropdown = document.getElementById("examDropdown");

        exams.forEach((exam) => {
            const dropdownItem = document.createElement("a");
            dropdownItem.className = "dropdown-item";
            dropdownItem.href = exam.route;
            dropdownItem.textContent = `${exam.name} Application`;

            examDropdown.appendChild(dropdownItem);
        });
    });
</script>
