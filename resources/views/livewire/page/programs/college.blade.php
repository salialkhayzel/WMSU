
<div>
    <!-- About Us Section -->
    <section class="about" style="padding:25px;">
        <div class="container" style="min-height: 600px;">
            @foreach($college_data as $item => $value)
                <div class="row">
                    <div class="col-md-6 d-none d-lg-flex">
                        <span>
                        <img src="{{asset('storage/content/programs/colleges/'.$value->college_logo)}}" alt="wmsu logo" width="400px">
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="about-content">
                            <h2>{{$value->college_header}}</h2>
                            <p>{{$value->college_content}}</p>

                            @if($department_data)
                                <div class="accordion" id="faqAccordion">
                                    <!-- Question 1 -->
                                    @foreach($department_data as $department_item => $department_value)
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="q1">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#a1" aria-expanded="false" aria-controls="a1">
                                                    {{$department_value->department_name}}
                                                </button>
                                            </h3>
                                            <div id="a1" class="accordion-collapse collapse " aria-labelledby="q1"
                                                data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                {{$department_value->department_details}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
           
        </div>
    </section>
</div>
