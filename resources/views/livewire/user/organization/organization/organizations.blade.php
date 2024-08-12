<div>
    @php
        use Carbon\Carbon;
        $offer = auth()->user()->organization->offers()->with('offer')->whereHas('offer',function ($sOffer){
            $sOffer->where([['start_date','<=',\Carbon\Carbon::parse(now())],['end_date','>=',\Carbon\Carbon::parse(now())],['status',1]]);
        })->get()??[];
        $count = 0;
        $slideIndex = 0;
    @endphp
    <x-slot name="title">Organizations</x-slot>
    
    
    
    
    
      <div class="banner-orignization " style="height:800px;min-height:105vh">
        <!--<div class="overlay"></div>-->
        <div id="carouselExampleInterval" data-bs-ride="carousel" class="carousel slide h-100">
            <div class="carousel-indicators">
                
    @if($offer != null && $offer->count() >1)
                @forelse($offer as $key => $item)
                    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="{{$slideIndex}}"
                            class="{{$slideIndex==0?'active':''}} custom_indicators" aria-current="true"
                            aria-label="Slide {{++$slideIndex}}">
                    </button>
                @empty
                @endforelse
                @endif
            </div>

            <div class="carousel-inner h-100">
                    @forelse($offer as $key => $item )
                            <div class="carousel-item  {{$key==0?'active':''}} h-100" data-bs-interval="10000">
                                <div class="item posiion-relative "
                             style="background-image: url({{$item->offer->getFile('banner')??authUser()->organization->getFile()??asset('assets/images/default/defaultbanner.svg') }})">
                                   
                                    <div class="carousel_caption col-10 col-md-4">
                                         
                                          <img
                                            src="{{ authUser() != null ? authUser()->organization->getFile() : ''  }}"
                                            alt=""
                                            class="mb-4" style="max-width: 200px ;    position: absolute;  top: 140px; left:12%"/>
                                        <div id="body" class=""> 
                                          <!--<div>-->
                                          <!--      <h1 class="m-0">{{$item->offer->translate('title')}}</h1> -->
                                          <!--</div>-->
                                            
                                            
                                        </div>
                                        <a href="{{route('user.organization.offer-details',$item->id)}}"
                                           class="btn btn-warning"
                                           style="padding:5px 10px; font-size: 17px !important; font-weight: 600;     position: absolute;     bottom: 5%;
    left: 50%; transform:translateX(-50%)"> Find more offers</a>
                                    </div>
    <!--                                <div class="h-100  col-9 d-flex flex-column justify-content-center  "-->
    <!--                                     style="background-image: url('{{ asset('assets/images/heroFill.svg') }}');background-repeat:no-repeat;background-size:cover">-->
    <!--                                    <img-->
    <!--                                        src="{{ $item->offer->getFile('banner')??authUser()->organization->getFile()??asset('assets/images/default/defaultbanner.svg')}}"-->
    <!--                                        class="d-block" alt="{{$item->offer->translate('title')}}}}"-->
    <!--                                        style="margin-left: 8%;-->
    <!--max-width: 63%;-->
    <!--max-height: 70%;-->
    <!--object-fit: fill;">-->
    <!--                                </div>-->
                                </div>
                            </div> 
    
    
    
    
    
    
    {{--
    <div class="banner-orignization ">
        <!--<div class="overlay"></div>-->
        <div id="carouselExampleInterval" data-bs-ride="carousel" class="carousel slide h-100">
            <div class="carousel-indicators">
                
    @if($offer != null && $offer->count() >1)
                @forelse($offer as $key => $item)
                    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="{{$slideIndex}}"
                            class="{{$slideIndex==0?'active':''}} custom_indicators" aria-current="true"
                            aria-label="Slide {{++$slideIndex}}">
                    </button>
                @empty
                @endforelse
                @endif
            </div>

            <div class="carousel-inner h-100">
                    @forelse($offer as $key => $item )
                            <div class="carousel-item  {{$key==0?'active':''}} h-100" data-bs-interval="10000">
                                <div class="item">
                                    <div class="carousel_caption col-10 col-md-4">
                                        <img
                                            src="{{ authUser() != null ? authUser()->organization->getFile() : ''  }}"
                                            alt=""
                                            class="mb-4" style="max-width: 200px "/>
                                        <div id="body" class="">
                                          <div>
                                                <h1 class="m-0">{{$item->offer->translate('title')}}</h1>
                                             <span class="discount ">Up to {{$item->offer->percent}} % Off </span>
                                          </div>
                                            <p class="m-0 fs-5">
                                                {{$item->offer->translate('brief')}}
                                            </p>
                                            <div class="count_time" id="count_time"
                                                 data-set="{{Carbon::parse($item->offer->end_date)->format('Y-m-d')}}">
                                                <div class="timer"><span id="days">  </span> Days</div>
                                                <div class="timer"><span id="hours">  </span> Hours</div>
                                                <div class="timer"><span id="minutes"> </span> Minutes</div>
                                                <div class="timer"><span id="seconds"></span> Seconds</div>
                                            </div>
                                        </div>
                                        <a href="{{route('user.organization.offer-details',$item->id)}}"
                                           class="btn btn-warning"
                                           style="padding:10px; font-size: 17px !important; font-weight: 500;"> Shop Now and Save Big!</a>
                                    </div>
                                    <div class="h-100  col-9 d-flex flex-column justify-content-center  "
                                         style="background-image: url('{{ asset('assets/images/heroFill.svg') }}');background-repeat:no-repeat;background-size:cover">
                                        <img
                                            src="{{ $item->offer->getFile('banner')??authUser()->organization->getFile()??asset('assets/images/default/defaultbanner.svg')}}"
                                            class="d-block" alt="{{$item->offer->translate('title')}}}}"
                                            style="margin-left: 8%;
    max-width: 63%;
    max-height: 70%;
    object-fit: fill;">
                                    </div>
                                </div>
                            </div>  --}}
                        @empty
                        <div class="banner-orignization d-flex  align-items-center"
                             style="background-image: url({{ authUser() != null ? authUser()->organization->getFile('banner') : '' }});">
                          
                            <div class="container-custom">
                                <div class="banner-text">
                                    <img src="{{ authUser() != null ? authUser()->organization->getFile() : ''  }}" alt=""
                                         class="mb-4" style="max-width: 200px;"/>
                                    <h1 class="fz-44px mb-3">@lang('app.welcome_to')</h1>
                                    <h1 class="banner-title">{{ authUser() != null ? authUser()->organization->translate('name') : ''  }}</h1>
                                </div>
                            </div>
                        </div>
                   @endforelse

            </div>
        </div>
    </div>
    @livewire('website.components.organization-courses')
    @if($offer != null && $offer->count() >=2)
        @livewire('website.components.offers')
    @endif
    @livewire('website.components.organization-products')
    <script src="{{ asset('js/timer.js') }}"></script>
</div>
