<div>
    <!-- Main Content -->
  <!-- Main Content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Manage Announcement</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Announcement</li>
                </ol>
            </nav>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="adminTabs">
            <li class="nav-item">
                <a class="nav-link show active" data-bs-toggle="tab" href="#announcement-tab">Announcement</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Announcement Tab -->
            <div class="tab-pane fade show active" id="announcement-tab">
                <br>
                <div class="d-flex mt-2">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">ADD</button>
                            </div>
                            @if(1)
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn" type="button" data-bs-toggle="modal" data-bs-target="#announcement-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="announcement-filter" tabindex="-1" role="dialog" aria-labelledby="announcement-filterLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="carousel-filterLabel">Sort&nbsp;Columns for Carousel</h5>
                            </div>
                            <hr>
                            <div class="modal-body">
                                @foreach($announcement_filter as $item => $value)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="announcement-filter-{{$loop->iteration}}"
                                        wire:model.defer="announcement_filter.{{$item}}">
                                    <label class="form-check-label" for="announcement-filter-{{$loop->iteration}}">
                                        {{$item}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                <button wire:click="announcementfilterView()" data-bs-dismiss="modal" 
                                    class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <table class="appointment-table">
                    <thead>
                        <tr>
                            @foreach ($announcement_filter as $item => $value)
                                @if($value)
                                    <th >{{$item}}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($announcement_data as $item => $value)
                        <tr>
                            @if($announcement_filter['#'])
                                <td>{{ $loop->index+1 }}</td>
                            @endif
                            @if($announcement_filter['Title'])
                                <td>{{$value->announcement_title }}</td>
                            @endif
                            @if($announcement_filter['Image'])
                                <td>
                                    <img src="{{asset('storage/content/announcement/'.$value->announcement_content_image)}}" alt="" style="height: 200px; ">
                                </td>
                            @endif
                            @if($announcement_filter['Type'])
                                <td>@if($value->announcement_type) Image @else Text @endif</td>
                            @endif
                            @if($announcement_filter['Content'])
                                <td>{{$value->announcement_content }}</td>
                            @endif
                            @if($announcement_filter['Start'])
                                <td>{{$value->announcement_start_date }}</td>
                            @endif
                            @if($announcement_filter['End'])
                                <td>{{$value->announcement_end_date }}</td>
                            @endif
                            @if($announcement_filter['Status'])
                                <td>@if($value->announcement_isactive) Active @else Disabled @endif</td>
                            @endif
                            @if($announcement_filter['Action'])
                                <td>
                                    @if($access_role['U'])
                                        <button class="btn btn-primary action-btn" wire:click="edit_announcement({{$value->announcement_id}})">Edit</button>
                                    @endif
                                    @if($access_role['D'])
                                        <button class="btn btn-danger action-btn" wire:click="delete_announcement({{$value->announcement_id}})">Delete</button>
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
        </div>
        <!-- End Tab Content -->

        <!-- Add Announcement Modal -->
        <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAnnouncementModalLabel">Add Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="add_announcement()">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="announcement_title" class="form-label">Title of Announcement</label>
                                <input type="text" class="form-control" wire:model="announcement_title" placeholder="Enter Title of Announcement" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Type of Announcement</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  wire:model="announcement_type" value="text" required>
                                    <label class="form-check-label"  for="announcement_type_txt">Text</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:model="announcement_type" value="image" required>
                                    <label class="form-check-label"  for="announcement_type_img">Image</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Enter Content of Announcement</label>
                                <textarea class="form-control" wire:model="announcement_content" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="announcement_image" class="form-label">Upload Image</label>
                                <input class="form-control" type="file" id="{{$announcement_content_image_id}}"wire:model.defer="announcement_content_image" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" wire:model="announcement_start_date" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <div class="input-group">
                                    <input type="date" class="form-control"  wire:model="announcement_end_date" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Set Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:model="announcement_is_active" value="active" required>
                                    <label class="form-check-label" for="Active">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:model="announcement_is_active" value="disabled" required>
                                    <label class="form-check-label" for="Active">Disabled</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Add Announcement</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editAnnouncementModal" tabindex="-1" aria-labelledby="editAnnouncementModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="save_edit_announcement({{$announcement_id}})">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="announcement_title" class="form-label">Title of Announcement</label>
                                <input type="text" class="form-control" wire:model="announcement_title" placeholder="Enter Title of Announcement" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Type of Announcement</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  wire:model="announcement_type" value="text" required>
                                    <label class="form-check-label"  for="announcement_type_txt">Text</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:model="announcement_type" value="image" required>
                                    <label class="form-check-label"  for="announcement_type_img">Image</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Enter Content of Announcement</label>
                                <textarea class="form-control" wire:model="announcement_content" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="announcement_image" class="form-label">Upload Image</label>
                                <input class="form-control" type="file" id="{{$announcement_content_image_id}}"wire:model.defer="announcement_content_image" accept="image/*" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" wire:model="announcement_start_date" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <div class="input-group">
                                    <input type="date" class="form-control"  wire:model="announcement_end_date" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Set Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:model="announcement_is_active" value="active" required>
                                    <label class="form-check-label" for="Active">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:model="announcement_is_active" value="disabled" required>
                                    <label class="form-check-label" for="Active">Disabled</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Save Announcement</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</div>
