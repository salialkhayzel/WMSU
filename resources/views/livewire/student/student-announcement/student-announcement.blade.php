<div role="tabpanel" class="tab-pane" id="schedule">
    <section class="schedule-section">
        <div class="container">
            <h2 class="section-title text-center mb-4">Announcements</h2>
            <div class="row  justify-content-center">
                @if($announcement_data)
                    @foreach($announcement_data as $key =>$value)
                        <div class="col-md-4 mb-4">
                            <div class="card announcement-card">
                                @if($value->announcement_content_image)
                                    <img src="{{asset('storage/content/announcement/'.$value->announcement_content_image)}}" alt="CET Announcement Image" class="card-img-top announcement-img">
                                @endif
                                <div class="card-body">
                                        <h3 class="card-title">{{$value->announcement_title }}</h3>
                                        <p class="card-text">{{$value->announcement_content }}</p>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @else
                    <div class="col-md-4 mb-4">
                        <div class="card announcement-card">
                            <img src="{{ asset('images/about/about.jpg') }}" alt="CET Announcement Image" class="card-img-top announcement-img">
                            <div class="card-body">
                                <h3 class="card-title">College Entrance Test (CET)</h3>
                                <p class="card-text">Date: October 10, 2023</p>
                                <p class="card-text">The College Entrance Test (CET) will be held on the specified date. Make sure to prepare!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card announcement-card">
                        <img src="{{ asset('images/slider/wm.jpg') }}" alt="NAT Announcement Image" class="card-img-top announcement-img">
                            <div class="card-body">
                                <h3 class="card-title">Nursing Aptitude Test (NAT)</h3>
                                <p class="card-text">Date: November 15, 2023</p>
                                <p class="card-text">Get ready for the Nursing Aptitude Test (NAT) coming up on the given date.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card announcement-card">
                        <img src="{{ asset('images/slider/campus.jpg') }}"  alt="GSAT Announcement Image" class="card-img-top announcement-img">
                            <div class="card-body">
                                <h3 class="card-title">Graduate School Admission Test (GSAT)</h3>
                                <p class="card-text">Date: December 5, 2023</p>
                                <p class="card-text">The Graduate School Admission Test (GSAT) is scheduled for the specified date. Don't miss it!</p>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Add more announcement cards as needed -->
            </div>
        </div>
    </section>
</div>




<style>
/* inline css */
.announcement-img {
    height: 200px;
    object-fit: cover;
}

.announcement-card {
    border: 1px solid #ccc;
    transition: transform 0.3s ease-in-out;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    height: 100%; /* Ensures same  height for all cards */
}

.announcement-card:hover {
    transform: translateY(-5px);
}

.card-title {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
}

.card-text {
    color: #555;
}

</style>
