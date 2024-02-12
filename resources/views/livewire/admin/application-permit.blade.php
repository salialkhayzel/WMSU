<div style="display: flex; justify-content: center;">
    <div style="width: 100%; max-width: 900px; border: 1px solid #ccc; padding: 20px; margin-top: 100px; margin-left: 290px;">
        <div class="container">
            <section class="layout d-flex" style="justify-content: center;">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="form-logo" style="height: 100px; margin-left: -100px;">
                <div  class="text-danger" style="text-align: center;">
                    <h4 style="font-size: 14px; margin-bottom: 5px;">Western Mindanao State University</h4>
                    <h5 style="font-size: 12px; margin-bottom: 5px;">Testing And Evaluation Center</h5>
                    <h6 style="font-size: 10px; margin-bottom: 5px;">Normal Road, Baliwasa, Zamboanga City</h6>
                    <p class="text-danger font-weight-bold">WMSU-CET APPLICATION PERMIT  <br>  School Year {{(date("Y")+1).' - '.(date("Y")+2)}}</p>
                </div>
                <img src="{{ asset('images/logo/tec.png') }}" alt="Logo" class="form-logo" style="height: 100px; margin-right: -100px;">
            </section>
            
            @if(isset($view_permit))
            <div style="text-align: center;">
                <div>
                    <!-- <legend style="font-size: 12px;">EXAM PERMIT</legend> -->
               
                    <h3 style="font-size: 16px; margin-bottom: 5px; font-weight: bold;">
                        {{$view_permit[0]->user_lastname.', '.$view_permit[0]->user_firstname.' '.$view_permit[0]->user_middlename}}
                    </h3>
                    <p style="font-size: 10px; margin-bottom: 5px;">{{$view_permit[0]->t_a_school_school_name}}</p>
                </div>
                
                <table class="table mt-2" style="font-size: 10px;">
                    <thead>
                        <tr>
                            <th scope="col" class="table-text border border-danger">Test Date</th>
                            <th scope="col" class="table-text border border-danger">Test Center</th>
                            <th scope="col" class="table-text border border-danger">Room No.</th>
                            <th scope="col" class="table-text border border-danger">Test Time</th>
                            <th scope="col" class="table-text border border-danger">Test Code</th>
                            <th scope="col" class="table-text border border-danger">High School Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="col" class="table-text border border-danger">{{date_format(date_create($view_permit[0]->test_date), "F d, Y ")}}</td>
                            <td scope="col" class="table-text border border-danger">{{$view_permit[0]->test_center_name}}</td>
                            <td scope="col" class="table-text border border-danger">{{ $view_permit[0]->school_room_id.' - '.$view_permit[0]->school_room_name }}</td>
                            <td scope="col" class="table-text border border-danger">
                                @if($view_permit[0]->t_a_ampm == 'AM')
                                    {{ $view_permit[0]->am_start.' - '.$view_permit[0]->am_end }}
                                @else
                                    {{$view_permit[0]->pm_start.' - '.$view_permit[0]->pm_end }}
                                @endif
                            </td>
                            <td scope="col" class="table-text border border-danger">{{$view_permit[0]->test_center_code }}</td>
                            <td scope="col" class="table-text border border-danger">{{$view_permit[0]->high_school_code.' - '.$view_permit[0]->high_school_name }}</td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="bottom-content mt-2 d-flex justify-content-center">
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <div class="image-container-left border border-danger rounded">
                                <img src="{{$qrcode}}" alt="" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="image-container-right border border-danger float-right">
                                <img src="{{asset('storage/application-requirements/t_a_formal_photo/'.$view_permit[0]->t_a_formal_photo)}}" alt="" style="object-fit: cover;" width="150" height="150">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
