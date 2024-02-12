<div>
    <!-- <x-loading-indicator/> -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tech support</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Tech support</li>
                </ol>
            </nav>
        </div><!-- End Right side columns -->
        <!-- Insert Section -->
        <section class="admin-content">
            <div class="chat-container">
                <div class="chat-table">
                    <div class="chat-column recent-message">
                        <div class="tab-content ">
                            <div class="tab-pane fade show active" id="messages" role="tabpanel">
                                <div class="row mb-2">
                                    <div class="col-9 pr-0">
                                        <div class="bg-light rounded search-bar">
                                            <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button-addon2" type="submit" class="btn"><i class="bi bi-search"></i></button>
                                            </div>
                                            <input type="search" placeholder="What're you searching for?" aria-describedby="button-addon2" class="form-control border-0 bg-light">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="navbar-nav btn-group p-0">
                                            <div class="nav-item dropdown">
                                            <a class="nav-link count-indicator btn btn-outline-light dropdown-toggle" id="filterDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bi bi-funnel"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="filterDropdown">
                                                <a class="dropdown-item filter-option" data-filter-category="all" tabindex="-1">
                                                <i class="bi bi-chat-square-text"></i>
                                                <span>All Chats</span>
                                                </a>
                                                <a class="dropdown-item filter-option" data-filter-category="active" tabindex="-1">
                                                <i class="bi bi-person-check"></i>
                                                <span>Active Contacts</span>
                                                </a>
                                                <a class="dropdown-item filter-option" data-filter-category="archived" tabindex="-1">
                                                <i class="bi bi-archive"></i>
                                                <span>Archived Chats</span>
                                                </a>
                                                <a class="dropdown-item filter-option" data-filter-category="spam" tabindex="-1">
                                                <i class="bi bi-bookmark-x"></i>
                                                <span>Spam Messages</span>
                                                </a>
                                                <a class="dropdown-item filter-option" data-filter-category="trash" tabindex="-1">
                                                <i class="bi bi-trash3"></i>
                                                <span>Trash Bin</span>
                                                </a>
                                            </div></div>
                                        </div>
                                        </div>
                                </div> 
                                <div class="scrollbar-y chat-box-six2 cqh-22 overflow-x-hidden" >
                                    <ul class="nav flex-column" >
                                        @forelse ($chat_box_list as $key => $value)
                      
                                            <li class="nav-item border border-dark rounded-4 mt-2 ml-3"  wire:click="chat_box_selected({{$value->cbc_chat_box_id}})" @if($value->cbc_user_id == $chat_box['chat_box_user_sender']) style="background-color:white;" @endif > 
                                                <a class="nav-link fade show p-0 my-3">
                                                    <div class="p-20 bb-1 d-flex align-items-center justify-content-between pull-up">
                                                        <div class="col-12 pr-10">
                                                            <div class="row mx-2">
                                                                <div class="col-1 mt-3 ">
                                                                    <span class="me-15 status-success avatar avatar-lg">
                                                                        @if( $value->user_profile_picture == 'default.png')
                                                                            <img src="{{ asset('images/logo/logo.png') }}" width="50px" style="border-radius: 50%;"class="bg-primary-light avr-round" alt="User Profile" >
                                                                        @else
                                                                            <img  class="bg-primary-light avr-round" style="border-radius: 50%;" width="50px"src="{{asset('storage/images/resize/'.$value->user_profile_picture)}}" alt="">
                                                                        @endif
                                                                        <!-- <img class="bg-primary-light avr-round" src="{{ asset('admin-assets/media/avatar/avatar-1.png') }}" alt="..."> -->
                                                                    </span>
                                                                </div>
                                                                <div class="col-8">
                                                                    <div class="text-left text-dark">
                                                                        <div class="row text-start">
                                                                            <div class="col-12">
                                                                                <p class=""><strong>{{ $value->user_firstname.' '.$value->user_middlename.' '.$value->user_lastname}}</strong></p>
                                                                                <span class="hover-primary ">{{$value->cbc_chat_content}}</span>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-2 text-end">
                                                                    <span class="d-block mb-5 fs-12 text-nowrap">{{$value->date_created}}</span>
                                                                    <!-- <span class="badge badge-primary">2</span> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </a> 
                                            </li>
                                        
                                        @empty
                                            <li class="nav-item"> 
                                                <a class="nav-link fade show p-0" data-toggle="tab" href="#second" role="tab">
                                                    <div class="p-20 bb-1 d-flex align-items-center justify-content-between pull-up">
                                                        <div class="d-flex align-items-center w-100 pr-10">
                                                            <span class="me-15 status-success avatar avatar-lg"><img class="bg-primary-light avr-round" style="border-radius: 50%;" src="{{ asset('images/logo/logo.png') }}" alt="..." width="40px"></span>
                                                            <div class="text-left text-dark w-100">
                                                            <span class="hover-primary mb-5"><strong>No Data yet</strong></span>
                                                            <!-- <p class="mb-0">Hi, are you there?</p> -->
                                                            </div>
                                                        </div>
                                                        <div class="text-end">
                                                        <!-- <span class="d-block mb-5 fs-12 text-nowrap">9:00 PM</span> -->
                                                        <span class="badge badge-primary"></span>
                                                        </div>
                                                    </div>
                                                </a> 
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="chat-column active-conversation" >
                    <div class="col-md-12 col-12">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade @if($chat_content) @else show active @endif" id="" role="tabpanel">
                                <div class="box">
                                    <div class="box-body px-20 py-10 bb-1 bbsr-0 bber-0">
                                        <div class="d-flex justify-content-between align-items-center w-p100">
                                            <div class="d-flex align-items-center w-100 pr-10">
                                                
                                            </div>
                                            <div class="mt-15 mt-md-0 d-flex align-items-center gap-2">

                                                <a href="#" class="hover-primary"><i class='bx bx-dots-vertical-rounded' ></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-body">
                                        <div class="d-flex justify-content-center align-items-center text-muted scrollbar-y chat-box-six cqh-22">
                                            <div class="row text-center px-2">
                                                <h3 class="col-12 text-secondary">Open a Message</h3>
                                                <p class="col-12">To open, click from the Chat List you want to view message.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade @if($chat_content) show active @endif" >
                                <div class="box">
                                    <div class="box-body px-20 py-10 bb-1 bbsr-0 bber-0">
                                        @if($chat_box)
                                        <div class="d-flex justify-content-between align-items-center w-p100">
                                            <div class="d-flex align-items-center w-100 px-10">
                                                <a class="me-15 status-success avatar avatar-lg" href="#modal-right">
                                                    
                                                    @if( $chat_box['user_profile_picture'] == 'default.png')
                                                    <img src="{{ asset('images/logo/logo.png') }}" width="50px" style="border-radius: 50%;" class="bg-primary-light avr-round" alt="User Profile" >
                                                    @else
                                                        <img  class="bg-primary-light avr-round" style="border-radius: 50%;" width="50px" src="{{asset('storage/images/resize/'.$chat_box['user_profile_picture'])}}" alt="">
                                                    @endif
                                                </a>
                                            <div>
                                                <a class="hover-primary mb-5" href="#"><strong>{{$chat_box['user_firstname'].' '.$chat_box['user_middlename'].' '.$chat_box['user_lastname']}}</strong></a>
                                                <p class="mb-0 fs-12 text-success">Active Now</p>
                                                </div>
                                            </div>
                                            <div class="mt-15 mt-md-0 d-flex align-items-center gap-2">
                                                <a href="#" class="hover-primary"><i class='bx bx-dots-vertical-rounded' ></i></a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="box-body mt-3 justify-content-center" wire:poll.5000ms="update_content_data()">
                                        <div class="overflow-auto ml-2" style="max-height:500px">
                                            @foreach ($chat_content as $key =>$value)
                                                @if($value->cbc_user_id != $chat_box['chat_box_user_sender'])
                                                <div class="alert alert text-primary text-end border-primary text-wrap" style="max-width:600px;word-wrap: break-word;">
                                                    {{$value->cbc_chat_content}}
                                                </div>
                                                
                                                @else
                                                
                                                <div class="alert alert text-dark text-start  text-wrap border-dark" style="max-width:600px;word-wrap: break-word;">
                                                    {{$value->cbc_chat_content}}
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer px-2">
                                <div class="input-group mt-3 p-2">
                                    <input type="text" class="form-control" wire:model.defer="chat_content_details" placeholder="Type your message...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" wire:click="send_message()"> Send </button>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- End Inserted Section -->

    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</div>
