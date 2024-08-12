<div>
    <div class="courses section-padding d-flex align-items-center flex-column">
        <div class="x-container container-custom">
            <div class="d-flex justify-content-center align-items-center position-relative">
                <h1 class=" orgnization-title">{!! __('app.organization_courses_title') !!}</h1>
            </div>
        </div>
        <div class="x-container mt-3 px-0 container-custom">
            <div class="slide-container swiper">
                <div class="slide-content">
                   <div class="card-wrapper swiper-wrapper">
                      @forelse ($courses as $course)
                      <div class="card swiper-slide">
                                <div class="image-content">
                                    <img src="{{ $course->getFile() }}" alt="@lang('app.alt_image')" loading="lazy" class="card-img">
                                                        </div>

                                <div class="card-content">
                                    <h2 class="name">{{ $course->translate('title') }}</h2>
                                    <p class="description">{{ $course->translate('brief') }}</p>

                                   <div class="d-flex" style="gap:10px"> 
                                   <span class="btn btn-warning px-3" onclick="appearVideo('{{$course->url}}')">Watch video</span>

                                   </div>
                                </div>
                            </div>
                      @empty

                      @endforelse
</div>
                  
                </div>

                <!-- {{-- <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div> --}} -->
                <div class="text-white d-flex justify-content-center pt-5 gap-3 slider-pagination">
                    <div class="slider-pagination-prev">
                        <img src="{{ asset('images/slider-prev.png') }}" alt="@lang('app.alt_image')" />
                    </div>
                    <div class="slider-pagination-next">
                        <img src="{{ asset('images/slider-prev.png') }}" alt="@lang('app.alt_image')" />
                    </div>
                </div>
                <!-- {{-- <div class="swiper-pagination"></div> --}} -->
            </div>
        </div>
    </div>
    @push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.css">
    @endpush
    @push('js')
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <!-- <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>  -->
    @endpush
    <div class="d-none" id="video_popup"> 
    <!-- {!! $popup !!} -->
    <div class="pop_up " >
                <div class="pop_up_content" style="width:max-content">
                    <div class="remove " style="" onclick=removeVideo()>
                        <i class="fa fa-close " style=""></i>
                    </div>  
                    <div class="video_body"  id="video_body">
                        <!-- <video src=""  id="video_source" width="100%" height="492" controls autoplay loop muted >
                         </video> -->
                    </div>
                </div>
            </div>
 </div> 
</div>

    <script src="{{ asset('assets/js/videoCourses.js') }}"> </script>

  