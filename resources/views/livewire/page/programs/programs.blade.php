<section class="features mt-5 mb-5 ">
    <div class="container " >
        <div class="row">
       

        @if($college_data)
        <div class="col-md-12 text-center">
            <h2 class="mb-4 " style="color:#990000">Western Mindanao State University Colleges</h2>
        </div>
        <div class="row justify-content-center">
            @foreach($college_data as $item => $value)
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="main-feature-box h-100">
                <img src="{{asset('storage/content/programs/colleges/'.$value->college_logo)}}" class="img-thumbnail mt-3 rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="College logo">

                    <div class="content-container overflow-hidden" style="max-height: 220px;">
                        <h4 class="my-3">{{$value->college_header}}</h4>
                        <p class="card-text text-wrap text-truncate">{{$value->college_content}}</p>
                    </div>
                    <div class="feature-link-wrapper mt-auto">
                        <a href="programs/{{$value->college_id}}" class="feature-link">Learn More <i class="bi bi-arrow-right-circle-fill"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>




        @else
        <div class="col-md-12 text-center">
            <h2 class="mb-4 text-secondary">No College Data</h2>
        </div>
        @endif
           
<style>
.main-feature-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; 
    text-align: center; 
    height: 100%;
    border: 1px solid #ccc; 
    padding: 15px;
}

img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.content-container {
    flex-grow: 1;
}

.content-container p {
    text-align: justify;
}

.feature-link-wrapper {
    margin-top: auto;
    text-align: center;
}
</style>
            <!-- <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="main-feature-box "style="height:400px;">
                <img src="{{ asset('images/logo/arch.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Architecture </h3>
                    <p class="card-text">Imparts design, construction, and urban planning education. Students learn architectural theory, building technology, and sustainability, honing skills in functional space creation...</p>

                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/islamic.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Asian and Islamic Studies</h3>
                    <p class="card-text"> Specializes in Asian cultures and Islamic studies, fostering understanding and knowledge of diverse traditions, languages, and societies in Asia and the Islamic world...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill position-sticky"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/crim.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Criminal Justice Education</h3>
                    <p class="card-text">Focuses on criminal justice theories, law enforcement, and judicial processes, preparing students for careers in law enforcement, legal practice, and criminal justice administration...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/eng.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Engineering</h3>
                    <p class="card-text">Offers comprehensive programs in various engineering disciplines, emphasizing theoretical knowledge and practical skills, preparing graduates for careers in technology, innovation, and engineering design...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/forest.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Forestry And Environmental Studies</h3>
                    <p class="card-text"> Concentrates on sustainable forestry practices and environmental conservation, educating students in forest management, biodiversity, and ecological preservation...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/eco.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Home Economics</h3>
                    <p class="card-text">Provides education in domestic sciences, focusing on family and consumer sciences, nutrition, interior design, and resource management, preparing students for roles in home management and related fields...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/law.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Law</h3>
                    <p class="card-text">Offers legal education, teaching jurisprudence, legal ethics, and advocacy skills, preparing students to become lawyers, judges, or legal consultants...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/cla.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Liberal Arts</h3>
                    <p class="card-text">Covers humanities, social sciences, and liberal arts education, fostering critical thinking, creativity, and cultural understanding, preparing graduates for diverse fields like media, education, and research...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/nursing.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Nursing </h3>
                    <p class="card-text">Specializes in nursing education and healthcare practices, training students to become competent and compassionate healthcare professionals, including nurses, nurse educators, and nurse practitioners...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/cpads.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Public Administration and Development Studies </h3>
                    <p class="card-text">Focuses on public policy, administration, and development studies, preparing students for roles in government, public service, and nonprofit organizations, emphasizing governance and social development...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link ">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/sports.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Sports Science and Physical Education </h3>
                    <p class="card-text">Concentrates on sports science, physical education, and athletic training, equipping students with knowledge and skills for careers in sports coaching, sports management, and fitness instruction...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link ">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2"style="height:400px;">
                <div class="main-feature-box">
                <img src="{{ asset('images/logo/math.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Science and Mathematics </h3>
                    <p class="card-text">Offers education in various scientific disciplines, including biology, chemistry, physics, and mathematics, emphasizing research, experimentation, and scientific inquiry...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2"style="height:400px;">
                <div class="main-feature-box">
                <img src="{{ asset('images/logo/social.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Social Work and Communnity Development </h3>
                    <p class="card-text">Focuses on social work theories, community engagement, and social welfare policies, preparing students for roles as social workers, community organizers, and advocates for social change...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2"style="height:400px;">
                <div class="main-feature-box">
                <img src="{{ asset('images/logo/educ.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Teacher Education </h3>
                    <p class="card-text">Specializes in teacher training and education pedagogy, equipping students with teaching methods, classroom management skills, and educational theories to become effective educators...</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More 
                        <i class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                <div class="main-feature-box"style="height:400px;">
                <img src="{{ asset('images/logo/cs.png') }}" width="50px" alt="wmsu logo">
                    <h3>College Of Computing Studies </h3>
                    <p class=>Focuses on computer science, information technology, and software engineering, preparing students for careers in software development, IT management, and technology innovation..s.</p>
                    <a href="{{ route('programs.agri') }}" class="feature-link mt-4">Learn More <i
                            class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div> -->

        </div>
    </div>
</section>