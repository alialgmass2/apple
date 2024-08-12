<div class="container">
    <div class="pt-6rem mh-800px">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>{{ authRegisterStep() }}</h1>
                {{-- <h1>{{ authUser() }}</h1> --}}
                <div class="d-flex justify-content-center align-items-center flex-column mx-auto" style="max-width:488px;">
                    <img class="finish-success-image" src="{{ asset('images/tick.png') }}" alt=""  />
                    <p class="mt-4 fz-16px text-center ">@lang('app.congratulations')</p>
                    <p  class="fz-16px text-center ">@lang('app.congratulations_2')</p>
                    <p  class="fz-16px text-center ">@lang('app.congratulations_3')</p>
                    <div class="mt-4 d-flex justify-content-between w-100">
                        <a class="btn btn-warning btn-lg btn-finish-orgnization" href="{{ route('user.organization.organizations') }}" >@lang('app.shop_now')</a>
                        <a class="btn btn-warning btn-lg btn-finish-dashboard " href="{{ route('user.dashboard') }}" >@lang('app.dashboard')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
