<div class="container mt-5" style="min-height:300px;">
    @if($contactus_data)
    <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-4 ">
            <legend class="font-weight-bold  ">Contact Us</legend>
        </div>
        @forelse ($contactus_data as $item =>$value)
        <div class="col-md-4">
            <div class="choose-item border text-center">
                <img src="{{asset('storage/content/contact_us/'.$value->cu_icon)}}"  alt="WMSU Testing Center" width="60px">
                <div class="choose-content">
                    <h3>{{$value->cu_header}}</h3>
                    <p>{{$value->cu_content}}</p>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
    @else
    <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-4">
            <legend class="font-weight-bold  ">Contact Us</legend>
        </div>
        <div class="col-md-4 mb-4">
            <div class="choose-item border text-center p-4">
                <i class="fas fa-map-marker-alt fa-3x mb-3" style="color:#57f75c"></i>
                <div class="choose-content">
                    <h3>Testing Center MAIN</h3>
                    <p>If you have any further questions, feel free to visit us at Normal Rd, Zamboanga City</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="choose-item border text-center p-4">
                <i class="fas fa-phone fa-3x mb-3" style="color:#57bff7"></i>
                <div class="choose-content">
                    <h3>+639365292521</h3>
                    <p>If you have any further questions, feel free to contact us at the provided number</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="choose-item border text-center p-4 " style="color:#eb4934">
                <i class="fas fa-envelope fa-3x mb-3"></i>
                <div class="choose-content">
                    <h3>iwmsutec@gmail.com</h3>
                    <p>If you have any further questions, feel free to email us</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
