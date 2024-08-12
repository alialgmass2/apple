<div>
    <div class="courses section-padding d-flex align-items-center flex-column pt-0">
        <div class="x-container container-custom">
            <div class="d-flex justify-content-center align-items-center position-relative ">
                <h1 class=" orgnization-title">Special Offers </h1>
            </div>
        </div>
        <div class="x-container mt-3 px-0 container-custom">
            <div class="slide-container swiper">
                <div class="slide-offer">
                    <div class="card-wrapper swiper-wrapper">
                        @forelse($organizations as $organization)
                                <div class="card swiper-slide">
                                    <div class="image-content p-4 offer_swiper_img">
                                        <div class="offer_mark">{{$organization->offer->percent}} % </div>
                                        <img
                                            src="{{$organization->offer->getFile('default_img')??'https://thumbs.dreamstime.com/z/special-offer-sign-wood-type-vintage-letterpress-grunge-painted-barn-background-31986810.jpg?ct=jpeg'}}"
                                            alt="" loading="lazy" class="card-img" style="object-fit:contain">
                                    </div>
                                    <div class="card-content">
                                        <h2 class="name">{{$organization->offer->translate('title')}}</h2>
                                        <p class="description">{{$organization->offer->translate('brief')}}</p>
                                        <div class="d-flex" style="gap:10px">
                                            {{$organization->offer->id}}df
                                            <a  href="{{route('user.organization.offer-details',$organization->id)}}"  class="btn btn-warning px-3"> Shop Now and Save Big!</a>


                                        </div>
                                    </div>
                                </div>
                            @empty
                        @endforelse
                    </div>

                </div>

                <div class="text-white d-flex justify-content-center pt-5 gap-3 slider-pagination">
                    <div class="pagination-prev">
                        <img src="{{ asset('images/slider-prev.png') }}" alt="@lang('app.alt_image')"/>
                    </div>
                    <div class="pagination-next">
                        <img src="{{ asset('images/slider-prev.png') }}" alt="@lang('app.alt_image')"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

