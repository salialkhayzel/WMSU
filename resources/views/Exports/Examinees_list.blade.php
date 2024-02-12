<!DOCTYPE html>
<html lang="en">
<head>
	<title>PDF</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="container">

		<!-- =============== TITLE =============== -->

		

		<!-- =============== COMPANY DETAILS =============== -->
        @foreach($assigned_rooms as $key =>$value)
        @if($key >0)
            <style>
            .page-break {
                page-break-after: always;
            }
            </style>
            <div class="page-break"></div>
        @endif
        <section id="header-title">
			<div class="row">
				<div class="col-xs-12">
					<h3>Proctor: {{$user_details['user_lastname'].', '.$user_details['user_firstname'].' '.$user_details['user_middlename']}}</h3>
				</div>
			</div>
		</section>

		<div class="clearfix"></div>
		<section id="examinees_list">
            
            <h3>Room Details</h3>
            <p>Test Center: {{$value->school_room_test_center}}</p>
            <p>Room Venue: {{$value->school_room_venue}}</p>
            <p>College: {{$value->school_room_college_name}}</p>
            <p>Room name: {{$value->school_room_name}}</p>
            <p>Room code: {{$value->school_room_id.' - '.$value->school_room_name}}</p>
            <p>Test Schedule :{{date_format(date_create( $value->school_room_test_date),"F d, Y ").' '.((intval(substr($value->school_room_test_time_start,0,2))-12>0) ? (intval(substr($value->school_room_test_time_start,0,2))-12).substr($value->school_room_test_time_start,2).' PM' :$value->school_room_test_time_start.' AM').' - '.((intval(substr($value->school_room_test_time_end,0,2))-12>0) ? (intval(substr($value->school_room_test_time_end,0,2))-12).substr($value->school_room_test_time_end,2).' PM' :$value->school_room_test_time_end.' AM')}}</p>  
                   
                                        
            <?php 
            $examinees = DB::table('test_applications as ta')
            ->select(
                'user_id',
                'user_name',
                'user_address',
                'user_firstname',
                'user_middlename',
                'user_lastname',
                't_a_id',
                DB::raw('DATE(ta.date_created) as date_applied'),
                'test_type_name'
                )
            ->join('users as u','u.user_id','ta.t_a_applicant_user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->where('ta.t_a_school_room_id','=',$value->school_room_id)
            ->where('t_a_isactive','=',1)
            ->get()
            ->toArray();
            ?>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Examinee name</th>
                            <th>Exam Code</th>
                            <th>Exam Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($examinees as $key =>$value) 
                        <tr>
                            <td>{{$value->user_lastname.', '.$value->user_firstname.' '.$value->user_middlename}}</td>
                            <td>{{$value->t_a_id.'-'.$value->date_applied }}</td>
                            <td>{{ $value->test_type_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
            
		</section>
        @endforeach
		<div class="clearfix"></div>

		<!-- =============== COLLECTION DETAILS =============== -->

	

	</div>
</body>
</html>