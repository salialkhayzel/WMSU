<div>
    <x-loading-indicator/>
    <!-- ======= Main Content ======= -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Setting</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Setting</li>
                </ol>
            </nav>
            <!-- First-level Tabs -->
       

        <!-- Second-level Tabs -->
        <div class="tab-content">
            <!-- Second-level Tabs -->
            <ul class="nav nav-tabs" id="secondLevelTabs">
                <li class="nav-item">
                    <a class="nav-link  @if($active == 'Carousel') show active @endif " wire:key="Carousel" wire:click="active_page('Carousel')" data-bs-toggle="tab" href="#carousel-tab">Carousel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if($active == 'Services') show active @endif " wire:key="Services" wire:click="active_page('Services')" data-bs-toggle="tab" href="#services-tab">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($active == 'WhyChooseUs') show active @endif " wire:key="WhyChooseUs" wire:click="active_page('WhyChooseUs')" data-bs-toggle="tab" href="#why-us-tab">Why Choose Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($active == 'FAQ') show active @endif " wire:key="FAQ" wire:click="active_page('FAQ')" data-bs-toggle="tab" href="#faq-tab">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($active == 'Feature') show active @endif " wire:key="Feature" wire:click="active_page('Feature')" data-bs-toggle="tab" href="#footer-tab">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($active == 'AboutUs') show active @endif " wire:key="AboutUs" wire:click="active_page('AboutUs')" data-bs-toggle="tab" href="#about-us-tab">About Us</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link @if($active == 'CTA') show active @endif " wire:key="CTA" wire:click="active_page('CTA')" data-bs-toggle="tab" href="#cta-tab">CTA</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link @if($active == 'Footer') show active @endif " wire:key="Footer" wire:click="active_page('Footer')" data-bs-toggle="tab" href="#footer-tab">Footer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($active == 'Contact') show active @endif " wire:key="Contact" wire:click="active_page('Contact')" data-bs-toggle="tab" href="#footer-tab">Contact Us</a>
                </li>
            </ul>

   
            <div class="tab-pane fade @if($active == 'Carousel') show active @endif " >
                <br>
                <div class="d-flex mt-2">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success   mx-1" data-bs-toggle="modal" data-bs-target="#AddCarouselModal"  >Add Carousel</button>
                            </div>
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#carousel-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                    <div class="modal fade" id="carousel-filter" tabindex="-1" role="dialog" aria-labelledby="carousel-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="carousel-filterLabel">Sort&nbsp;Columns for Carousel</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($carousel_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="carousel-filter-{{$loop->iteration}}"
                                            wire:model.defer="carousel_filter.{{$item}}">
                                        <label class="form-check-label" for="carousel-filter-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="carouselfilterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <table class="application-table">
                    <thead>
                        <tr>
                        @foreach ($carousel_filter as $item => $value)
                            @if($value)
                                <th >{{$item}}</th>
                            @endif
                        @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carousel_data as $item => $value)
                            <tr>
                                @if($carousel_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($carousel_filter['Carousel content'])
                                    <td>
                                        <div >
                                            {{$value->carousel_header_title}}
                                        </div>
                                        <br>
                                        <img src="{{asset('storage/content/carousel/'.$value->carousel_content_image)}}" alt="" style="height: 200px; ">
                                    </td>
                                @endif
                                @if($carousel_filter['Paragraphs'])
                                    <td class="align-middle">
                                        <p>{{$value->carousel_paragraph_paragraph}}</p>
                                    </td>
                                @endif
                                @if($carousel_filter['Order'])
                                    <td class="align-middle"> 
                                        <div class="btn-group-vertical btn-group-sm " role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_up_carousel({{$value->carousel_id}})"><i class="bx bx-up-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_down_carousel({{$value->carousel_id}})"><i class="bx bx-down-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                        </div>
                                    </td>
                                @endif
                                @if($carousel_filter['Action'])
                                    <td class="align-middle"> 
                                        @if($access_role['R']==0 && 0)
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ViewCarouselModal" >View</button>
                                        @endif
                                        @if($access_role['U']==1)
                                        <button class="btn btn-success" wire:click="edit_carousel({{$value->carousel_id}})" >Edit</button>
                                        @endif
                                        @if($access_role['D']==1)
                                        <button class="btn btn-danger" wire:click="delete_carousel({{$value->carousel_id}})">Delete</button>
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
                <div class="modal fade" id="AddCarouselModal" tabindex="-1" role="dialog" aria-labelledby="AddCarouselModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddCarouselModalLabel">Add Carousel</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="add_carousel()">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Carousel Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="carousel_header_title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Paragraph:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="carousel_paragraph_paragraph" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Carousel Background Image:</label><br>
                                        <input  type="file" class="form-control" wire:model.defer="carousel_content_image" accept="image/jpg"required>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="EditCarouselModal" tabindex="-1" role="dialog" aria-labelledby="EditCarouselModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditCarouselModalLabel">Edit Carousel</h5>
                            </div>
                            <hr>
                            @if(isset($edit_carousel_data))
                            <form wire:submit.prevent="save_edit_carousel({{$carousel_id}})">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Carousel Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="carousel_header_title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Paragraph:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="carousel_paragraph_paragraph" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Carousel Background Image:</label><br>
                                        <input  type="file" class="form-control" wire:model.defer="carousel_content_image" id=carousel-{{$carousel_image_id}} >
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade @if($active == 'WhyChooseUs') show active @endif " >
                <br>
                <div class="d-flex mt-2">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success   mx-1" wire:click="add_wcu()">Add WCU</button>
                            </div>
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#wcu-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                    <div class="modal fade" id="wcu-filter" tabindex="-1" role="dialog" aria-labelledby="wcu-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="wcu-filterLabel">Sort&nbsp;Columns for WCU</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($wcu_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="wcu-filter-{{$loop->iteration}}"
                                            wire:model.defer="wcu_filter.{{$item}}">
                                        <label class="form-check-label" for="services-filter-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="carouselfilterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
              
                </div>
                <!--  Carousel content goes here -->
                <table class="application-table">
                    <thead>
                        <tr>
                        @foreach ($wcu_filter as $item => $value)
                            @if($value)
                                <th >{{$item}}</th>
                            @endif
                        @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wcu_data as $item => $value)
                            <tr>
                            @if($wcu_filter['#'])
                                <td>{{ $loop->index+1 }}</td>
                            @endif
                            @if($wcu_filter['Logo'])
                                <td>
                                    <img src="{{asset('storage/content/whychooseus/'.$value->wcu_logo)}}" alt="" style="height: 200px; ">
                                </td>
                            @endif
                            @if($wcu_filter['Header'])
                                <td>
                                    <div>
                                        {{$value->wcu_header}}
                                    </div>
                                </td>
                            @endif
                            @if($wcu_filter['Content'])
                                <td class="align-middle">
                                    <p>{{$value->wcu_content}}</p>
                                </td>
                            @endif
                            @if($wcu_filter['Order'])
                                <td class="align-middle"> 
                                    <div class="btn-group-vertical btn-group-sm " role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-dark" wire:click="move_up_wcu({{$value->wcu_order}})"><i class="bx bx-up-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                        <button type="button" class="btn btn-outline-dark" wire:click="move_down_wcu({{$value->wcu_order}})"><i class="bx bx-down-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                    </div>
                                </td>
                            @endif
                            @if($wcu_filter['Action'])
                                <td class="align-middle"> 
                                    @if($access_role['R']==0)
                                    <button class="btn btn-primary" wire:click="view_wcu({{$value->wcu_id}})" >View</button>
                                    @endif
                                    @if($access_role['U']==1)
                                    <button class="btn btn-success" wire:click="edit_wcu({{$value->wcu_id}})" >Edit</button>
                                    @endif
                                    @if($access_role['D']==1)
                                    <button class="btn btn-danger" wire:click="delete_wcu({{$value->wcu_id}})">Delete</button>
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

                <div class="modal fade" id="AddWCUModal" tabindex="-1" role="dialog" aria-labelledby="AddWCUModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddWCUModalLabel">Add WCU</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="save_add_wcu()">
                                <div class="modal-body">
                                   <div class="form-group">
                                        <label for="addRoomCapacity">Logo:</label><br> 
                                        <input  type="file" class="form-control" wire:model.defer="wcu.wcu_logo" accept="image/jpg"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="wcu.wcu_header" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Content:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="wcu.wcu_content" required></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>          

                <div class="modal fade" id="EditWCUModal" tabindex="-1" role="dialog" aria-labelledby="EditWCUModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditWCUModalLabel">Edit WCU</h5>
                            </div>
                            <hr>
                            @if($wcu['wcu_id'])
                            <form wire:submit.prevent="save_edit_wcu({{$wcu['wcu_id']}})">
                                <div class="modal-body">
                                   <div class="form-group">
                                        <label for="addRoomCapacity">Logo:</label><br>
                                        <input  type="file" class="form-control" wire:model.defer="wcu.wcu_logo" accept="image/jpg">
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="wcu.wcu_header" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Content:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="wcu.wcu_content" required></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>   
            </div>

            <div class="tab-pane fade @if($active == 'AboutUs') show active @endif ">
                <table class="application-table">
                    <thead>
                        <tr>
                            @foreach ($aboutus_filter as $item => $value)
                                @if($value)
                                    <th >{{$item}}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>        
                    @forelse ($aboutus_data as $item => $value)
                            <tr>
                                @if($aboutus_filter['Image'])
                                    <td>
                                        <img src="{{asset('storage/content/about_us/'.$value->au_image)}}" alt="" style="height: 200px; ">
                                    </td>
                                @endif
                                @if($aboutus_filter['Header'])
                                    <td class="align-middle">
                                        <p>{{$value->au_header}}</p>
                                    </td>
                                @endif
                                @if($aboutus_filter['Content'])
                                    <td class="align-middle">
                                        <p>{{$value->au_content}}</p>
                                    </td>
                                @endif
                                @if($aboutus_filter['Action'])
                                    <td class="align-middle"> 
                                        @if($access_role['R']==0 && 0)
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ViewCarouselModal" >View</button>
                                        @endif
                                        @if($access_role['U']==1)
                                        <button class="btn btn-success" wire:click="edit_aboutus({{$value->au_id}})" >Edit</button>
                                        @endif
                                        @if($access_role['D']==0)
                                        <button class="btn btn-danger" wire:click="delete_aboutus({{$value->au_id}})">Delete</button>
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
                    <!-- Modal -->
                <div class="modal fade" id="EditAboutusModal" tabindex="-1" role="dialog" aria-labelledby="EditAboutusModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditAboutusModalLabel">Edit About us</h5>
                            </div>
                            <hr>
                            @if($aboutus['au_id'])
                            <form wire:submit.prevent="save_edit_aboutus({{$aboutus['au_id']}})">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Image:</label><br>
                                        <input  type="file" class="form-control" wire:model.defer="aboutus.au_image"  accept="image/jpg" >
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="aboutus.au_header" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Content:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="aboutus.au_content" required></textarea>
                                    </div>
                                  
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body d-flex justify-content-center">
                                    <h5> Are you sure you want to delete?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success">Yes</button>
                                </div>
                            </div>
                    </div>
                </div> -->
                <!--  modal trigger -->
                
            </div>

            <div class="tab-pane fade @if($active == 'Services') show active @endif " >
                <br>
                <div class="d-flex mt-2">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success   mx-1" wire:click="add_service()" >Add Services</button>
                            </div>
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#services-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                    <div class="modal fade" id="services-filter" tabindex="-1" role="dialog" aria-labelledby="services-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="services-filterLabel">Sort&nbsp;Columns for Services</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($services_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="services-filter-{{$loop->iteration}}"
                                            wire:model.defer="services_filter.{{$item}}">
                                        <label class="form-check-label" for="services-filter-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="carouselfilterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <table class="application-table">
                    <thead>
                        <tr>
                            @foreach ($services_filter as $item => $value)
                                @if($value)
                                    <th >{{$item}}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services_data  as $item => $value)
                            <tr>
                                @if($services_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($services_filter['Logo'])
                                    <td>
                                        <img src="{{asset('storage/content/services/'.$value->service_logo)}}" alt="" style="height: 200px; ">
                                    </td>
                                @endif
                                @if($services_filter['Header'])
                                    <td>
                                        <div>
                                            {{$value->service_header}}
                                        </div>
                                    </td>
                                @endif
                                @if($services_filter['Content'])
                                    <td class="align-middle">
                                        <p>{{$value->service_content}}</p>
                                    </td>
                                @endif
                                @if($services_filter['Order'])
                                    <td class="align-middle"> 
                                        <div class="btn-group-vertical btn-group-sm " role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_up_service({{$value->service_order}})"><i class="bx bx-up-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_down_service({{$value->service_order}})"><i class="bx bx-down-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                        </div>
                                    </td>
                                @endif
                                @if($services_filter['Action'])
                                    <td class="align-middle"> 
                                        @if($access_role['R']==0)
                                        <button class="btn btn-primary" wire:click="view_service({{$value->service_id}})" >View</button>
                                        @endif
                                        @if($access_role['U']==1)
                                        <button class="btn btn-success" wire:click="edit_service({{$value->service_id}})" >Edit</button>
                                        @endif
                                        @if($access_role['D']==1)
                                        <button class="btn btn-danger" wire:click="delete_service({{$value->service_id}})">Delete</button>
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

                <div class="modal fade" id="AddServiceModal" tabindex="-1" role="dialog" aria-labelledby="AddServiceModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddServiceModalLabel">Add Service</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="save_add_service()">
                                <div class="modal-body">
                                   <div class="form-group">
                                        <label for="addRoomCapacity">Logo:</label><br>
                                        <input  type="file" class="form-control" wire:model.defer="service.service_logo" accept="image/jpg"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="service.service_header" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Content:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="service.service_content" required></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>          

                <div class="modal fade" id="EditServiceModal" tabindex="-1" role="dialog" aria-labelledby="EditServiceModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditServiceModalLabel">Edit Service</h5>
                            </div>
                            <hr>
                            @if($service['service_id'])
                            <form wire:submit.prevent="save_edit_service({{$service['service_id']}})">
                                <div class="modal-body">
                                   <div class="form-group">
                                        <label for="addRoomCapacity">Logo:</label><br>
                                        <input  type="file" class="form-control" wire:model.defer="service.service_logo" accept="image/jpg">
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="service.service_header" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Content:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="service.service_content" required></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>   
            </div>

            <div class="tab-pane fade" id="cta-tab">
                <table class="application-table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Header</th>
                        <th scope="col">Paragraph</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tr>
                        <td scope="row">1</td>
                        <td>
                            <img src="{{ asset('images/logo/logo.png') }}" alt="" style="width:250px; height: 200px; ">
                        </td>
                        
                            <td class="align-middle">
                                <p>Expert Instructors</p>
                                
                            </td>
                            <td>
                                <p>Our team of highly qualified instructors brings years of experience and expertise to guide you through your learning journey.</p>
                            </td>
                            
                        <td class="align-middle"> 
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                                                Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="ModalLabel">Edit CTA </h5>
                                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                        <div class="col-md-15 mb-5">
                                                                            <label for="photo" class="form-label">Change Why Us Logo</label>
                                                                                <div>
                                                                                    <img src="{{ asset('images/logo/logo.png') }}" alt="" style="width:250px; height: 200px; ">
                                                                                </div>
                                                                            <input type="file" class="form-control mt-2" id="photo" name="photo" accept=".jpg,.png,.jpeg" required>
                                                                                <div class="mt-2">
                                                                                        <h5>Change Header</h5>
                                                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="Header" required>
                                                                                </div>
                                                                                <div>
                                                                                    <h5>Change Paragraph</h5>
                                                                                        <textarea class="form-control" id="message" name="message" rows="10" required="" style="height: 80px;"></textarea>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                        </div>
                                                </div>
                                            </div>
                            
                                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#deletemodal">Delete </button>

                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                
                                                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body d-flex justify-content-center">
                                                                                                <h5> Are you sure you want to delete?</h5>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                                <button type="button" class="btn btn-success">Yes</button>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                        </td>
                    </tr>
                </table>
                        
            </div>

            <div class="tab-pane fade @if($active == 'Footer') show active @endif ">
                <br>
                <div class="d-flex mt-2">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success   mx-1" wire:click="add_footer()" >Add Footer</button>
                            </div>
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#footer-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                    <div class="modal fade" id="footer-filter" tabindex="-1" role="dialog" aria-labelledby="faq-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="faq-filterLabel">Sort&nbsp;Columns for Footer</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($footer_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="footer-filter-{{$loop->iteration}}"
                                            wire:model.defer="footer_filter.{{$item}}">
                                        <label class="form-check-label" for="footer-filter-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="carouselfilterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
                <table class="application-table">
                    <thead>
                        <tr>
                            @foreach ($footer_filter as $item => $value)
                                @if($value)
                                    <th >{{$item}}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($footer_data  as $item => $value)
                            <tr>
                                @if($footer_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($footer_filter['Header'])
                                    <td class="align-left">    
                                        <p>{{$value->footer_type_details}}</p>
                                    </td>
                                @endif
                                @if($footer_filter['Content'])
                                    <td class="align-left">    
                                        <span>
                                    <?php 
                                    $footer_type_id =$value->footer_type_id;
                                    
                                    $footers = DB::table('footer')
                                         ->where('footer_type_id','=',$value->footer_type_id)
                                         ->orderBy('footer_order')
                                         ->get()
                                         ->toArray();
                                    ?>
                                        @forelse ($footers as $item => $footer_value)
                                            <p>{{$footer_value->footer_content}}
                                                <span> </span>
                                                @if($access_role['U']==1 )
                                                    <button class="btn btn-success" wire:click="edit_footer_each({{$footer_value->footer_id}})" >Edit</button>
                                                @endif 
                                                @if($access_role['D']==1 )
                                                    <button class="btn btn-danger" wire:click="delete_footer_each({{$footer_value->footer_id}})" >Delete</button>
                                                @endif 
                                            </p> 
                                        @empty
                                        @endforelse
                                        </span>
                                    </td>
                                @endif
                               
                                @if($footer_filter['Order'])
                                    <td class="align-middle"> 
                                        <div class="btn-group-vertical btn-group-sm " role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_up_faq({{$value->footer_type_order}})"><i class="bx bx-up-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_down_faq({{$value->footer_type_order}})"><i class="bx bx-down-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                        </div>
                                    </td>
                                @endif
                                @if($footer_filter['Action'])
                                    <td class="align-middle"> 
                                        @if($access_role['R']==1 )
                                            <button class="btn btn-primary" wire:click="add_footer_in_type({{$value->footer_type_id}})" >Add</button>
                                        @endif 
                                        @if($access_role['U']==1)
                                            <button class="btn btn-success" wire:click="edit_footer_in_type({{$value->footer_type_id}})" >Edit</button>
                                        @endif
                                        @if($access_role['D']==1)
                                            <button class="btn btn-danger" wire:click="delete_footer_in_type({{$value->footer_type_id}})">Delete</button>
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

                <div class="modal fade" id="AddFooterTypeModal" tabindex="-1" role="dialog" aria-labelledby="AddFooterTypeModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddFooterTypeModalLabel">Add Footer</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="save_add_footer()">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Footer:</label>
                                        <input  type="text" class="form-control" wire:model.defer="footer.footer_type_details" required></input>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="DeleteFooterTypeModal" tabindex="-1" role="dialog" aria-labelledby="DeleteFooterTypeModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DeleteFooterTypeModalLabel">Delete Footer</h5>
                            </div>
                            <hr>
                            @if(isset($footer['footer_type_id']))
                            <form wire:submit.prevent="delete_footer({{$footer['footer_type_id']}})">
                                <div class="modal-body">
                                    <p>Are you sure you want to delete ({{$footer['footer_type_details']}})</p>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="EditFooterTypeModal" tabindex="-1" role="dialog" aria-labelledby="EditFooterTypeModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditFooterTypeModalLabel">Add Footer</h5>
                            </div>
                            <hr>
                            @if(isset($footer['footer_type_id']))
                            <form wire:submit.prevent="save_edit_footer_in_type({{$footer['footer_type_id']}})">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Footer:</label>
                                        <input  type="text" class="form-control" wire:model.defer="footer.footer_type_details" required></input>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-success">
                                        Edit
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>




                <div class="modal fade" id="AddFooterModal" tabindex="-1" role="dialog" aria-labelledby="AddFooterModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddFooterModalLabel">Add to @if(strlen($footer['footer_type_details'])>0){{$footer['footer_type_details']}}@endif</h5>
                            </div>
                            <hr>
                            @if($footer_each['footer_type_id'])
                            <form wire:submit.prevent="save_add_footer_in_type({{$footer_each['footer_type_id']}})">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Footer Content:</label>
                                        <input  type="text" class="form-control" wire:model.defer="footer_each.footer_content" required></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Icon:</label>
                                        <input  type="text" class="form-control" wire:model.defer="footer_each.footer_icon" ></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Link:</label>
                                        <input  type="text" class="form-control" wire:model.defer="footer_each.footer_link" ></input>
                                    </div>

                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="EditFooterModal" tabindex="-1" role="dialog" aria-labelledby="EditFooterModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditFooterModal">Edit to @if(strlen($footer['footer_type_details'])>0){{$footer['footer_type_details']}}@endif</h5>
                            </div>
                            <hr>
                            @if($footer_each['footer_id'])
                            <form wire:submit.prevent="save_edit_footer_each({{$footer_each['footer_id']}})">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Footer Content:</label>
                                        <input  type="text" class="form-control" wire:model.defer="footer_each.footer_content" required></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Icon:</label>
                                        <input  type="text" class="form-control" wire:model.defer="footer_each.footer_icon" ></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Link:</label>
                                        <input  type="text" class="form-control" wire:model.defer="footer_each.footer_link" ></input>
                                    </div>

                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="DeleteFooterModal" tabindex="-1" role="dialog" aria-labelledby="DeleteFooterModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DeleteFooterModalLabel"></h5>
                            </div>
                            <hr>
                            @if($footer_each['footer_id'])
                            <form wire:submit.prevent="delete_edit_footer_each({{$footer_each['footer_id']}})">
                                <div class="modal-body">
                                    <p>Are you sure you want to delete ({{$footer_each['footer_content']}})? </p>

                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane @if($active == 'FAQ') show active @endif">
                <br>
                <div class="d-flex mt-2">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success   mx-1" wire:click="add_faq()" >Add FAQ</button>
                            </div>
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#faqs-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                    <div class="modal fade" id="faqs-filter" tabindex="-1" role="dialog" aria-labelledby="faq-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="faq-filterLabel">Sort&nbsp;Columns for FAQ</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($faq_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="faq-filter-{{$loop->iteration}}"
                                            wire:model.defer="faq_filter.{{$item}}">
                                        <label class="form-check-label" for="carousel-filter-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="carouselfilterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                <table class="application-table">
                    <thead>
                        <tr>
                            @foreach ($faq_filter as $item => $value)
                                @if($value)
                                    <th >{{$item}}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($faq_data  as $item => $value)
                            <tr>
                                @if($faq_filter['#'])
                                    <td>{{ $loop->index+1 }}</td>
                                @endif
                                @if($faq_filter['Question'])
                                    <td class="align-left">    
                                        <p>{{$value->faq_question}}</p>
                                    </td>
                                @endif
                                @if($faq_filter['Answer'])
                                    <td class="align-left">
                                        <p>{{$value->faq_answer}}</p>
                                    </td>
                                @endif
                                @if($faq_filter['Order'])
                                    <td class="align-middle"> 
                                        <div class="btn-group-vertical btn-group-sm " role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_up_faq({{$value->faq_order}})"><i class="bx bx-up-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                            <button type="button" class="btn btn-outline-dark" wire:click="move_down_faq({{$value->faq_order}})"><i class="bx bx-down-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                        </div>
                                    </td>
                                @endif
                                @if($faq_filter['Action'])
                                    <td class="align-middle"> 
                                        @if($access_role['R']==0 && 0)
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ViewCarouselModal" >View</button>
                                        @endif
                                        @if($access_role['U']==1)
                                        <button class="btn btn-success" wire:click="edit_faq({{$value->faq_id}})" >Edit</button>
                                        @endif
                                        @if($access_role['D']==1)
                                        <button class="btn btn-danger" wire:click="delete_faq({{$value->faq_id}})">Delete</button>
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
               
                <div class="modal fade" id="DeleteFAQModal" tabindex="-1" role="dialog" aria-labelledby="DeleteFAQModal" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DeleteFAQModal">Delete FAQ</h5>
                            </div>
                            <hr>
                            @if($faq['faq_id'])
                            <form wire:submit.prevent="confirm_delete_faq({{$faq['faq_id']}})">
                                <div class="modal-body">
                                <p>Are you sure you want to delete this faq?</p>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="AddFAQModal" tabindex="-1" role="dialog" aria-labelledby="AddFAQModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddFAQModalLabel">Add FAQ</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="save_add_faq()">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Question:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="faq.faq_question" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Answer:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="faq.faq_answer" required></textarea>
                                    </div>
                                  
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="EditFAQModal" tabindex="-1" role="dialog" aria-labelledby="EditFAQModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditFAQModalLabel">Edit FAQ</h5>
                            </div>
                            <hr>
                            @if($faq['faq_id'])
                            <form wire:submit.prevent="save_edit_faq({{$faq['faq_id']}})">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Question:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="faq.faq_question" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Answer:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="faq.faq_answer" required></textarea>
                                    </div>
                                  
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade @if($active == 'Feature') show active @endif " >
                <br>
                <div class="d-flex mt-2">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success   mx-1" wire:click="add_feature()">Add Feature</button>
                            </div>
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#feature-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                    <div class="modal fade" id="feature-filter" tabindex="-1" role="dialog" aria-labelledby="feature-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="feature-filterLabel">Sort&nbsp;Columns for Feature</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($feature_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="feature-filter-{{$loop->iteration}}"
                                            wire:model.defer="feature_filter.{{$item}}">
                                        <label class="form-check-label" for="services-filter-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="carouselfilterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
               
                </div>
                <!--  Carousel content goes here -->
                <table class="application-table">
                    <thead>
                        <tr>
                        @foreach ($feature_filter as $item => $value)
                            @if($value)
                                <th >{{$item}}</th>
                            @endif
                        @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feature_data as $item => $value)
                            <tr>
                            @if($feature_filter['#'])
                                <td>{{ $loop->index+1 }}</td>
                            @endif
                            @if($feature_filter['Header'])
                                <td>
                                    <div>
                                        {{$value->feature_header}}
                                    </div>
                                </td>
                            @endif
                            @if($feature_filter['Content'])
                                <td class="align-middle">
                                    <p>{{$value->feature_content}}</p>
                                </td>
                            @endif
                            @if($feature_filter['Button name'])
                                <td class="align-middle">
                                    <p>{{$value->feature_button_name}}</p>
                                </td>
                            @endif
                            @if($feature_filter['Link'])
                                <td class="align-middle">
                                    <p>{{$value->feature_link}}</p>
                                </td>
                            @endif
                            @if($feature_filter['Order'])
                                <td class="align-middle"> 
                                    <div class="btn-group-vertical btn-group-sm " role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-dark" wire:click="move_up_feature({{$value->feature_order}})"><i class="bx bx-up-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                        <button type="button" class="btn btn-outline-dark" wire:click="move_down_feature({{$value->feature_order}})"><i class="bx bx-down-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                    </div>
                                </td>
                            @endif
                            @if($feature_filter['Action'])
                                <td class="align-middle"> 
                                    @if($access_role['R']==0)
                                    <button class="btn btn-primary" wire:click="view_feature({{$value->feature_id}})" >View</button>
                                    @endif
                                    @if($access_role['U']==1)
                                    <button class="btn btn-success" wire:click="edit_feature({{$value->feature_id}})" >Edit</button>
                                    @endif
                                    @if($access_role['D']==1)
                                    <button class="btn btn-danger" wire:click="delete_feature({{$value->feature_id}})">Delete</button>
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

                <div class="modal fade" id="AddFeatureModal" tabindex="-1" role="dialog" aria-labelledby="AddFeatureModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddFeatureModalLabel">Add Feature</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="save_add_feature()">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="feature.feature_header" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Content:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="feature.feature_content" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Button name:</label>
                                        <input  type="text" class="form-control" wire:model.defer="feature.feature_button_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Link:</label>
                                        <input  type="text" class="form-control" wire:model.defer="feature.feature_link" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>          

                <div class="modal fade" id="EditFeatureModal" tabindex="-1" role="dialog" aria-labelledby="EditFeatureModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditFeatureModalLabel">Edit Feature</h5>
                            </div>
                            <hr>
                            @if($feature['feature_id'])
                            <form wire:submit.prevent="save_edit_feature({{$feature['feature_id']}})">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="feature.feature_header" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Content:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="feature.feature_content" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Button name:</label>
                                        <input  type="text" class="form-control" wire:model.defer="feature.feature_button_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Link:</label>
                                        <input  type="text" class="form-control" wire:model.defer="feature.feature_link" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>   
            </div>

            <div class="tab-pane fade @if($active == 'Contact') show active @endif " >
                <br>
                <div class="d-flex mt-2">
                    <div class="col-md-3 sort-container">
                        <div class="d-flex">
                            @if(1)
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success   mx-1" wire:click="add_contact()">Add Contact</button>
                            </div>
                            <button class="btn btn-secondary me-2 d-flex justify-content-between sort-btn " type="button" data-bs-toggle="modal" data-bs-target="#contact-filter">
                                <i class="bi bi-funnel-fill me-1"></i>
                                <div><span class='btn-text'>Columns</span></div>
                            </button>
                            @endif
                            
                            <!-- wire:model.debounce.500ms="search" -->
                        </div>
                    </div> 
                    <div class="modal fade" id="contact-filter" tabindex="-1" role="dialog" aria-labelledby="contact-filterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contact-filterLabel">Sort&nbsp;Columns for Contact us</h5>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    @foreach($contactus_filter as $item => $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="contact-filter-{{$loop->iteration}}"
                                            wire:model.defer="contactus_filter.{{$item}}">
                                        <label class="form-check-label" for="contact-filter-{{$loop->iteration}}">
                                            {{$item}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button wire:click="carouselfilterView()" data-bs-dismiss="modal" 
                                        class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                <!--  Carousel content goes here -->
                <table class="application-table">
                    <thead>
                        <tr>
                        @foreach ($contactus_filter as $item => $value)
                            @if($value)
                                <th >{{$item}}</th>
                            @endif
                        @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contactus_data as $item => $value)
                            <tr>
                            @if($contactus_filter['#'])
                                <td>{{ $loop->index+1 }}</td>
                            @endif
                            @if($contactus_filter['Icon'])
                                <td>
                                    <div>
                                    <img src="{{asset('storage/content/contact_us/'.$value->cu_icon)}}" alt="" style="height: 200px; ">
                                    </div>
                                </td>
                            @endif
                            @if($contactus_filter['Header'])
                                <td>
                                    <div>
                                        {{$value->cu_header}}
                                    </div>
                                </td>
                            @endif
                            @if($contactus_filter['Content'])
                                <td class="align-middle">
                                    <p>{{$value->cu_content}}</p>
                                </td>
                            @endif
                        
                            @if($contactus_filter['Order'])
                                <td class="align-middle"> 
                                    <div class="btn-group-vertical btn-group-sm " role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-dark" wire:click="move_up_contact({{$value->cu_order}})"><i class="bx bx-up-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                        <button type="button" class="btn btn-outline-dark" wire:click="move_down_contact({{$value->cu_order}})"><i class="bx bx-down-arrow-alt" style="font-size:20px; vertical-align: middle;" ></i></button>
                                    </div>
                                </td>
                            @endif
                            @if($contactus_filter['Action'])
                                <td class="align-middle"> 
                                    @if($access_role['R']==0)
                                    <button class="btn btn-primary" wire:click="view_contact({{$value->cu_id}})" >View</button>
                                    @endif
                                    @if($access_role['U']==1)
                                    <button class="btn btn-success" wire:click="edit_contact({{$value->cu_id}})" >Edit</button>
                                    @endif
                                    @if($access_role['D']==1)
                                    <button class="btn btn-danger" wire:click="delete_contact({{$value->cu_id}})">Delete</button>
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

                <div class="modal fade" id="AddContactModal" tabindex="-1" role="dialog" aria-labelledby="AddContactModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddContactModalLabel">Add Contact Us</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="save_add_contact()">
                                <div class="modal-body">
                                <div class="form-group">
                                        <label for="addRoomCapacity">Icon:</label>
                                        <input  type="file" class="form-control" wire:model.defer="contactus.cu_icon"  accept="image/jpg">
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="contactus.cu_header" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Content:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="contactus.cu_content" required></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>          

                <div class="modal fade" id="EditContactModal" tabindex="-1" role="dialog" aria-labelledby="EditContactModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditContactModalLabel">Edit Contact Us</h5>
                            </div>
                            <hr>
                            @if($contactus['cu_id'])
                            <form wire:submit.prevent="save_edit_contact({{$contactus['cu_id']}})">
                                <div class="modal-body">
                                <div class="form-group">
                                        <label for="addRoomCapacity">Icon:</label>
                                        <input  type="file" class="form-control" wire:model.defer="contactus.cu_icon" >
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Header:</label>
                                        <input  type="text" class="form-control" wire:model.defer="contactus.cu_header" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRoomCapacity">Content:</label>
                                        <textarea  type="text" class="form-control" wire:model.defer="contactus.cu_content" required></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>         
                <div class="modal fade" id="DeleteContactModal" tabindex="-1" role="dialog" aria-labelledby="DeleteContactModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DeleteContactModalLabel">Delete Contact Us</h5>
                            </div>
                            <hr>
                            @if($contactus['cu_id'])
                            <form wire:submit.prevent="save_delete_contact({{$contactus['cu_id']}})">
                                <div class="modal-body">
                               <p>Are you sure you want to delet the contact?</p>
                                <hr>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary btn-block"data-bs-dismiss="modal" id='btn_close1'>Close</button>
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>        
            </div>
 
 
        </div>                        
    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</div>
