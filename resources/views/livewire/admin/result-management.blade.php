<div>
    <x-loading-indicator/>
    <!-- Main Content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Result Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Examination</li>
                </ol>
            </nav>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="adminTabs">
            <li class="nav-item">
                <a class="nav-link @if($active == 'results') show active @endif " href="#" wire:key="results" wire:click="active_page('results')" >Result Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($active == 'examinees') show active @endif " href="#"  wire:key="examinees" wire:click="active_page('examinees')" >Examinees Report</a>
            </li>
        </ul>
        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Result Management Tab -->
            <div class="tab-pane fade show @if($active == 'results') show active @endif " id="result-management-tab">
                <div class="container-fluid">
                    <div class="d-flex mt-2">
                            @if(1)
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn" type="button" data-bs-toggle="modal" data-bs-target="#result-management-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadResultModal" >
                                Upload Result
                            </button>
                                
                            <!-- Modal for Upload Result -->
                            <div class="modal fade" id="uploadResultModal" tabindex="-1" role="dialog" aria-labelledby="uploadResultModalLabel" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadResultModalLabel" >Upload Result</h5>
                                            <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </div>
                                        </div>
                                    
                                        <!-- Upload Result Form -->
                                        <!-- <form wire:submit.prevent="upload_file()" enctype="multipart/form-data"> -->
                                            <div class="modal-body">
                                                <select name="" id="" class="form-select" wire:model="exam_type_name" wire:change="update_filter()">
                                                    <option value="0">Select Exam Type</option>
                                                    @foreach($exam_types as $item => $value)
                                                    <option value="{{$value->test_type_name}}">{{$value->test_type_details}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-group">
                                                    <label for="resultFile">Upload Result File:</label>
                                                    <input type="file" class="form-control-file"  id="importCSV" wire:change="importresults()" @if($exam_type_name == '0') disabled @endif />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success" wire:click="save_import_results()">Save</button>
                                            </div>
                                        <!-- </form> -->
                                        <!-- End Upload Result Form -->
                                    </div>
                                </div>
                                <script>
                                    $('#importCSV').on("change", function(){ 
                                        var formData = new FormData();
                                        formData.append("file", document.getElementById("importCSV").files[0]);
                                        console.log( formData)
                                        $.ajax({
                                            url: 'upload',
                                            type: 'POST',
                                            data: formData ,
                                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                            contentType: false, 
                                            processData: false,
                                            success: function(data){
                                            }
                                        });
                                    
                                        
                                    });


                                        // $("form#data").submit(function() {
                                        //     
                                        //     return false;
                                        // });
                                </script>
                            </div>
                            <div class="modal fade" id="result-management-filter" tabindex="-1" role="dialog" aria-labelledby="result-management-filterLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns</h5>
                                        </div>
                                        <hr>
                                        <div class="modal-body">
                                            @foreach($results_filter as $item => $value)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                                    wire:model.defer="results_filter.{{$item}}">
                                                <label class="form-check-label" for="filtering-{{$loop->iteration}}">
                                                    {{$item}}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <hr>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                            <button wire:click="filterView()" data-bs-dismiss="modal" 
                                                class="btn btn-primary">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- Result Table -->
                            <div class="table-responsive">
                                <table class="application-table">
                                    <thead>
                                        <tr>
                                        @foreach ($results_filter as $item => $value)
                                            @if($loop->last && $value )
                                                <th class="text-center">
                                                    Action
                                                </th>
                                            @elseif($value)
                                                <th>{{$item}}</th>
                                            @endif
                                        @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($complete_results as $item => $value)
                                        <tr wire:key="item-{{ $value->t_a_id }}">
                                            @if($results_filter['#'])
                                                <td>{{ $loop->index+1 }}</td>
                                            @endif
                                            @if($results_filter['Code'])
                                                <td>{{$value->t_a_id.'-'.$value->date_applied }}</td>
                                            @endif
                                            @if($results_filter['Applicant name'])
                                                <td>{{ $value->user_fullname }}</td>
                                            @endif
                                            @if($results_filter['Exam type'])
                                                <td class="text-align center">{{ $value->test_type_name }}</td>
                                            @endif
                                            @if($results_filter['Date applied'])
                                                <td class="text-align center">{{date_format(date_create($value->date_applied),"F d, Y ")}}</td>
                                            @endif
                                            @if($results_filter['Status'])
                                                <td class="text-align center">Complete</td>
                                            @endif
                                            @if($results_filter['CET OAPR'])
                                                <td class="text-align center">{{$value->t_a_cet_oapr }}</td>
                                            @endif
                                            @if($results_filter['English Proficiency'])
                                                <td class="text-align center">{{$value->t_a_cet_english_procficiency }}</td>
                                            @endif
                                            @if($results_filter['Reading Comprehension'])
                                                <td class="text-align center">{{$value->t_a_cet_reading_comprehension }}</td>
                                            @endif
                                            @if($results_filter['Science Processing Skills'])
                                                <td class="text-align center">{{$value->t_a_cet_science_process_skills}} </td>
                                            @endif
                                            @if($results_filter['Quantitative Skills'])
                                                <td class="text-align center">{{$value->t_a_cet_quantitative_skills}} </td>
                                            @endif
                                            @if($results_filter['Abstract Thinking'])
                                                <td class="text-align center">{{$value->t_a_cet_abstract_thinking_skills}} </td>
                                            @endif
                
                                            @if($results_filter['Actions'] )
                                                <td>
                                                    @if($access_role['R']==1)
                                                    <button class="btn btn-primary" wire:click="view_application({{$value->t_a_id}})">View</button>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <td class="text-center font-weight-bold" colspan="42">
                                                NO RECORDS 
                                            </td>
                                        @endforelse
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Result Table -->
                        </div>
                    </div>
            <!-- End Result Management Tab -->

            <!-- Examinees Management Tab -->
            <div class="tab-pane fade @if($active == 'examinees') show active @endif " id="examinees-management-tab">
                <div class="container-fluid">
                    <!-- Button to download examinee list -->
                    <div class="d-flex mt-2">
                            @if(1)
                                <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn" type="button" data-bs-toggle="modal" data-bs-target="#examinees-management-filter">
                                    <i class="bi bi-funnel-fill me-1"></i>
                                    <div><span class='btn-text'>Columns</span></div>
                                </button>
                            @endif
                        <a href="#" class="btn btn-success " wire:click="download_option()">Download Examinee List</a>  
                        <div class="modal fade" id="examinees-management-filter" tabindex="-1" role="dialog" aria-labelledby="examinees-management-filterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sortingModalLabel">Sort&nbsp;Columns</h5>
                                    </div>
                                    <hr>
                                    <div class="modal-body">
                                        @foreach($examinees_filter as $item => $value)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                                wire:model.defer="examinees_filter.{{$item}}">
                                            <label class="form-check-label" for="filtering-{{$loop->iteration}}">
                                                {{$item}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                        <button wire:click="filterView()" data-bs-dismiss="modal" 
                                            class="btn btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>

                    <div class="table-responsive">
                        <table class="application-table">
                            <thead>
                                <tr>
                                    @foreach ($examinees_filter as $item => $value)
                                        @if($loop->last && $value )
                                            <th class="text-center">
                                                Action
                                            </th>
                                        @elseif($value)
                                            <th>{{$item}}</th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($examinees as $item => $value)
                            <tr wire:key="item-{{ $value->t_a_id }}">
                                @if($examinees_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($examinees_filter['Code'])
                                    <td>{{$value->t_a_id.'-'.$value->date_applied }}</td>
                                @endif
                                @if($examinees_filter['Applicant name'])
                                    <td>{{ $value->user_fullname }}</td>
                                @endif
                                @if($examinees_filter['Exam type'])
                                    <td class="text-align center">{{ $value->test_type_name }}</td>
                                @endif
                                @if($examinees_filter['Date applied'])
                                    <td class="text-align center">{{date_format(date_create($value->date_applied),"F d, Y ")}}</td>
                                @endif
                                @if($examinees_filter['Status'])
                                    <td class="text-align center">Accepted</td>
                                @endif
                                @if($examinees_filter['Actions'] )
                                    <td>
                                        @if($access_role['R']==1)
                                        <button class="btn btn-primary" wire:click="view_application({{$value->t_a_id}})">View</button>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                            @empty
                            <td class="text-center font-weight-bold" colspan="42">
                                    NO RECORDS 
                                </td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Examinees Management Tab -->
        </div>
        <div class="modal fade" id="examinees_filter" tabindex="-1" role="dialog" aria-labelledby="examinees_filterLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="examinees_filterLabel">Download Filter</h5>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <select name="" id="" class="form-select" wire:model="exam_type_name" wire:change="update_filter()">
                            <option value="0">Select Exam Type</option>
                            @foreach($exam_types as $item => $value)
                            <option value="{{$value->test_type_name}}">{{$value->test_type_details}}</option>
                            @endforeach
                        </select>
                        @if($exam_type_name == '0')
                        @elseif($exam_type_name == 'CET')
                            @foreach($cet_filter as $item => $value)
                                <div class="form-check">
                                    @if($item  == '#')
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @elseif($item  == 'First name')
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @elseif($item  == 'Middle name')
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @elseif($item  == 'Last name')
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @elseif($item  == 'id')
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @elseif($item  == 'Reading Comprehension')
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @elseif($item  == 'English Proficiency')
                                        <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                            wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @elseif($item  == 'Science Processing Skills')
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @elseif($item  == 'Quantitative Skills')
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @elseif($item  == 'Abstract Thinking')
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @elseif($item  == 'CET OAPR')
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}" disabled>
                                    @else
                                    <input class="form-check-input" type="checkbox" id="filtering-{{$loop->iteration}}"
                                        wire:model.defer="cet_filter.{{$item}}">
                                    @endif
                                    <label class="form-check-label" for="filtering-{{$loop->iteration}}">
                                        {{$item}}
                                    </label>
                                </div>
                            @endforeach
                        @endif

                        
                    </div>
                    <hr>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal" id='btn_close1'>Close</button>
                        <button wire:click="download_file()" data-bs-dismiss="modal" 
                            class="btn btn-primary">
                            Download Examinees
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Back to Top Button -->
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </div>
</main>
