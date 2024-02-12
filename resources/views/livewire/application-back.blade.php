<div class="container border border-dark mt-5 mb-5 px-3 py-3">
    <div class="container border border-4 w-80">
        <div class="text-danger font-weight-bold"> Course to take up:(Choose from the list of WMSU Campuses and Undergraduate degree programs/courses offered by WMSU posted in your school's bulletin board.)</div>
            <div class="row px-2 py-3">
                <div class="col-md-4">
                    <select class="form-select form-select-lg mb-4" aria-label=".form-select-lg example" style="width: 380px; height: 50px;">
                        <option selected>1st Choice</option>
                        <option value="1">College Of Architecture- Campus A Main</option>
                        <option value="2">College of Computing Studies- Campus B</option>
                        <option value="3">College Of Criminal Justice Education- Campus B</option>
                    </select>

                    <select class="form-select form-select-lg mb-4" aria-label=".form-select-lg example" style="width: 380px; height: 50px; ">
                        <option selected>3rd Choice</option>
                        <option value="1">College Of Architecture- Campus A Main</option>
                        <option value="2">College of Computing Studies- Campus B</option>
                        <option value="3">College Of Criminal Justice Education- Campus B</option>
                    </select>
                </div>
                <div class="col-md-4">           
                    <select class="form-select form-select-lg mb-4" aria-label=".form-select-lg example" style="width: 380px; height: 50px; margin-left: 50px;">
                        <option selected>2nd Choice</option>
                        <option value="1">College Of Architecture- Campus A Main</option>
                        <option value="2">College of Computing Studies- Campus B</option>
                        <option value="3">College Of Criminal Justice Education- Campus B</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="text-danger font-weight-bold">Socio Econic Data: Furnish all required information. Under Column "Highest Education Finished" indicate the educational level actually completed (eg. Grade III, Third Year high school, High School Gradute, Second Year, College Graduate,etc) </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Parents</th>
                        <th scope="col">Citizenship</th>
                        <th scope="col">Highest Education Finished</th>
                        <th scope="col">Work/Occupation</th>
                        <th scope="col">Employer/Place of Work</th>
                        <th scope="col">Monthly Income/Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Father</th>
                        <td>
                            <select class="form-select" aria-label="Default select example" style="width: 100px; height: 50px;">
                                <option selected>Select</option>
                                <option value="1">Pinoy</option>
                                <option value="2">Japanese</option>
                                <option value="3">Thai</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="high-school-name" wire:model="ueb_shs_school_name" name="high_school_name" placeholder="Highest Education Finished" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="high-school-name" wire:model="ueb_shs_school_name" name="high_school_name" placeholder="Work/Occupation" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="high-school-name" wire:model="ueb_shs_school_name" name="high_school_name" placeholder="Employer/Place of Work" required>
                        </td>
                        <td>
                            <select class="form-select" aria-label="Default select example" style="width: 180px; height: 50px;">
                                <option selected>Select</option>
                                <option value="1">Below ₱5,000</option>
                                <option value="2">₱5,000-₱15,000</option>
                                <option value="3">₱15,000-₱20,000 </option>
                            </select>
                        </td>
                    
                    </tr>
                    <tr>
                        <th scope="row">Mother</th>
                        <td> <select class="form-select" aria-label="Default select example" style="width: 100px; height: 50px;">
                                <option selected>Select</option>
                                <option value="1">Pinoy</option>
                                <option value="2">Japanese</option>
                                <option value="3">Thai</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="high-school-name" wire:model="ueb_shs_school_name" name="high_school_name" placeholder="Highest Education Finished" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="high-school-name" wire:model="ueb_shs_school_name" name="high_school_name" placeholder="Work/Occupation" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="high-school-name" wire:model="ueb_shs_school_name" name="high_school_name" placeholder="Employer/Place of Work" required>
                        </td>
                        <td>
                            <select class="form-select" aria-label="Default select example" style="width: 180px; height: 50px;">
                                <option selected>Select</option>
                                <option value="1">Below ₱5,000</option>
                                <option value="2">₱5,000-₱15,000</option>
                                <option value="3">₱15,000-₱20,000 </option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-danger font-weight-bold">
                <p style="display: inline;">Do you know how to use a computer?</p>
                <input type="checkbox" id="checkbox1"> <label for="checkbox1">Yes</label>
                <input type="checkbox" id="checkbox2"> <label for="checkbox2">No</label>
            </div>
            <div class="text-danger font-weight-bold">
                <p class="d-inline-block mr-3">Are you a member of a Cultural/Ethnic group?</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox1">
                    <label class="form-check-label" for="checkbox1">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox1">
                    <label class="form-check-label" for="checkbox1">Yes,if yes, please check any one below.</label>
                </div>
                <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox3">
                    <label class="form-check-label mr-3" for="checkbox3">Badjao</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox4">
                    <label class="form-check-label mr-3" for="checkbox4">Kalibugan</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox5">
                    <label class="form-check-label mr-3" for="checkbox5">Maranaw</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox6">
                    <label class="form-check-label mr-3" for="checkbox6">Subanen</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox7">
                    <label class="form-check-label mr-3" for="checkbox7">Yakan</label>
                </div>
                <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox8">
                    <label class="form-check-label mr-3" for="checkbox8">Bagobo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox9">
                    <label class="form-check-label mr-3" for="checkbox9">Maguindanao</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox10">
                    <label class="form-check-label mr-3" for="checkbox10">Samal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox11">
                    <label class="form-check-label mr-3" for="checkbox11">Tausug</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox12">
                    <input type="text" class="form-control" id="high-school-name" wire:model="ueb_shs_school_name" name="high_school_name" placeholder="Others Specify" required>
                </div>
            </div>
            <div  class="text-danger font-weight-bold mt-2">
                <p class="mb-1" >Religous affiliation </p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox10">
                    <label class="form-check-label mr-3" for="checkbox10">Protestant</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox11">
                    <label class="form-check-label mr-3" for="checkbox11">Islam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox11">
                    <label class="form-check-label mr-3" for="checkbox11">Roman Catholic</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox12">
                    <input type="text" class="form-control" id="high-school-name" wire:model="ueb_shs_school_name" name="high_school_name" placeholder="Others Specify" required>
                </div>
            </div>
            <div class="container border border-danger mt-5 rounded">
                <div class="form-check form-check-inline">
                    <p class="text-danger mt-2"> <input class="form-check-input" type="checkbox" id="checkbox11"> <label class="form-check-label mr-3" for="checkbox11">Accept</label>I herby accept that i have read and understood all the instructions in connection with my application for the WMSU-CET. I further accept that all information supplied herein and the supporting documents attached are true and correct if found otherwise, my exam shall be considered null and void. I also allow WMSU-TECT to process and store the data i have provided in this form in accordance with the provision of the Data Privacy Act of 2012</p>
                </div>
                
            </div>
            <div>
                <p class="text-danger mt-5">Only prospective freshmen will be allowed to take the WMSU CET schedule for November 2023. Transferess Should join in the Febraruary 2024 exam.</p>
            </div>
                <div>
                    <Span class="text-danger font-weight-bold">IMPORTANT</Span>
                    <p class="text-danger">1. An Applicant can take  the WMSU-CET for S.Y 2024-2025, <span class="text-danger font-weight-bold text-decoration-underline" >ONLY ONCE,</span>wheter in the Main Campus or any other test Venue</p>
                    <p class="text-danger">For further inquries, Call WMSU-Testing and Evaluation Center at 09066131868 or email at tec@wmsu.edu.ph</p>
                </div>
                <div class="text-center" >
                    <legend class="text-danger font-weight-bold">REMINDERS</legend>
                </div>
                <div class="row">
                    <div class="col-sm-5 col-md-6 text-danger">a. You must be at the test venue <span class="text-danger font-weight-bold">30 minutes before the test time </span><br>b. Bring your Test Permit and one (1) short-sized transparent plastic envelope with the following materials inside: 
                        <ul>
                            <li>At least 2 Mongol No.2 pencils </li>
                            <li>Sharpener </li>
                            <li>Eraser of good quality </li>
                        </ul> c. For your Snacks, you are only allowed to bring water, biscuits and candies.
                    </div>
                    <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0 text-danger mb-5 px-2">d. Mobile Phones, calculators, smart watches, cameras and other eletronic gadgets are not ALLOWED during the test. <br> e. Observer proper dress code when you are in the test venue. Slippers, shorts, sleeveless shirts and blouses, jackets/sweatshirts and hats/caps are NOT allowed. <br> <span class="text-danger font-weight-bold">f. Present this Test Permit when claiming results.</span>
                    </div>
                </div>
            <div align="end">
                <a href="http://wmsutec/student/application-back" class="btn btn-danger">Submit Application</a>
            </div>
            <div align="Start">
                <a href="http://wmsutec/student/application-form" class="btn btn-danger">Back</a>
            </div>
        </div>
                    
    </div>

 </div>