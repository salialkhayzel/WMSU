<div>
    <!-- Results Tab Content -->
    <script src="https://cdn.jsdelivr.net/npm/jspdf@1.5.3/dist/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <div role="tabpanel" class="tab-pane" id="results">
        <section class="results-section">
            <div class="container">
                <h2 class="section-title">Exam Results</h2>
                <table class="table table-bordered">
                    <thead style="background-color: #990000; color: white; position: sticky; top: 0;">
                        <tr>
                            <th>Exam</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complete_results as $key=> $value)
                            <tr>
                                <td>{{ $value->test_type_details}}</td>
                                <td>
                                <!-- Button trigger another Modal (assuming it's a different modal) -->
                                <button type="button" class="btn btn-primary" wire:click="view_result({{$value->t_a_id}})">
                                    View
                                </button>
                            </td>
                            </tr>
                        @empty
                            <td class="text-center font-weight-bold" colspan="42">
                                NO RECORDS 
                                <br>
                                <a  href="{{ route('student.application') }} "> 
                                <button type="button" class="btn btn-success " style="width: 70px;">Apply</button>
                                </a>
                            </td>
                        @endforelse
                        
                        <!-- Add more exam result rows as needed -->
                    </tbody>
                </table>
                        
                <!-- CET result Modal -->
                <div class="modal fade" id="uniqueCetResultModal" tabindex="-1" role="dialog" aria-labelledby="uniqueCetModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%; margin: 1.60rem auto;">
                        <div class="modal-content">
                            <div class="modal-body" id="to_print">
                                <div>
                                    <section class="layout d-flex justify-content-center">
                                        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="form-logo" style="height: 80px;">
                                        <div style="text-align: center;">
                                            <h4 class="text-danger">Western Mindanao State University</h4>
                                            <h5 class="text-danger">Testing And Evaluation Center</h5>
                                            <h6 class="text-danger">Normal Road, Baliwasa, Zamboanga City</h6>
                                            <p class="text-danger font-weight-bold">WMSU-CET APPLICATION RESULTS <br> School Year {{(date("Y")+1).' - '.(date("Y")+2)}}</p>
                                        </div>
                                        <img src="{{ asset('images/logo/tec.png') }}" alt="Logo" class="form-logo" style="height: 80px;">
                                    </section>
                                    @if($result)
                                    <div style="text-align: center;">
                                        <div>
                                            <h3>{{$result['user_fullname']}}</h3>
                                            <h6 style="font-size: 15px; margin-bottom: 5px;">School from: Southern City Collges</h6>
                                        </div>
                                        <table class="table border border">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">CET PARTS</th>
                                                    <th>English Proficiency</th>
                                                    <th>Reading Comprehension</th>
                                                    <th>Science Processing Skills</th>
                                                    <th>Quantitative Skills</th>
                                                    <th>Abstract Thinking</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="font-weight:bold;">Percentile Rank</td>
                                                    <td>{{$result['t_a_cet_english_procficiency']}}</td>
                                                    <td>{{$result['t_a_cet_reading_comprehension']}}</td>
                                                    <td>{{$result['t_a_cet_science_process_skills']}}</td>
                                                    <td>{{$result['t_a_cet_quantitative_skills']}}</td>
                                                    <td>{{$result['t_a_cet_abstract_thinking_skills']}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-weight:bold;">OAPR</td>
                                                    <td colspan="5" style="font-weight:bold;">{{$result['t_a_cet_oapr']}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <div style="text-align: center;">
                                            <p>Your WMSU CET score herein is subject to verification against WMSU CET Masterlist</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" onclick="print_this('to_print')">Print</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    window.print_this = function(id) {
                        var prtContent = document.getElementById(id);
                        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
                        
                        WinPrint.document.write('<link rel="stylesheet" type="text/css"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
                        // To keep styling
                        /*var file = WinPrint.document.createElement("link");
                        file.setAttribute("rel", "stylesheet");
                        file.setAttribute("type", "text/css");
                        file.setAttribute("href", 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
                        WinPrint.document.head.appendChild(file);*/

                        
                        WinPrint.document.write(prtContent.innerHTML);
                        WinPrint.document.close();
                        WinPrint.setTimeout(function(){
                        WinPrint.focus();
                        WinPrint.print();
                        WinPrint.close();
                        }, 1000);
                    }
                </script>
            </div>
        </section>
    </div>
</div>




