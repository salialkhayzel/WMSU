<div>
    <footer class="text-center text-lg-start bg-light text-muted">
        <!-- Section: Social media -->
        <!-- <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
           
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
               
            </div>
        </section> -->
        <!-- Section: Social media -->

        @if($footer_data)
        <section class="ewan ko lord">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    @foreach ($footer_data  as $item => $value)
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mt-4 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                {{$value->footer_type_details}}
                            </h6>
                            <?php 
                            $footer_type_id =$value->footer_type_id;
                            $footers = DB::table('footer')
                                ->where('footer_type_id','=',$value->footer_type_id)
                                ->orderBy('footer_order')
                                ->get()
                                ->toArray();
                            ?>
                            @forelse ($footers as $item => $footer_value)
                                <p>
                                    <a href="{{$footer_value->footer_link}}" class="text-reset"><i class="{{$footer_value->footer_icon}}"></i>{{$footer_value->footer_content}}</a>
                                </p>
                            @empty
                            @endforelse
                            
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
        <div class="text-center p-4" style="background-color:#990000; color:white;">
            © {{date("Y")}} Copyright:
            <a class="text-reset fw-bold" href="">WMSU TEC</a>
        </div>
    </footer>
</div>
