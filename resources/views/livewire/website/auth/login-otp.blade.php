<div class="container">
    <div class="pt-6rem mh-800px">
        <div class="row justify-content-center">
            <div class="col-12 d-flex flex-column align-items-center">

                <div class="d-flex justify-content-center align-items-center flex-column">
                    {{-- <img src="{{ asset('images/logo.png') }}" alt="" /> --}}
                    <img src="{{ authUser() != null ? authUser()->organization->getFile('logo_login') : '' }}" alt="" class="auto-width-height" />
                    <h2 class="mt-2  ">@lang('app.login_otp')</h2>
                    <p class="text-center  ">@lang('app.signin_message')</p>
                    @if (Session::has('success'))
                    <p class="text-success">@lang('app.otp_resent')</p>
                    @endif
                </div>
                <div class="auth-inputs mt-3">
                    <form wire:submit.prevent="login" class="h-250px">
                        <div class="step-three xh-100 d-flex flex-column align-items-center">
                            <div class="input-group mb-4">
                                <div id="inputs" class="inputs">
                                    <input class="input" type="text" inputmode="numeric" maxlength="1"
                                        wire:model="otp_1" />
                                    <input class="input" type="text" inputmode="numeric" maxlength="1"
                                        wire:model="otp_2" />
                                    <input class="input" type="text" inputmode="numeric" maxlength="1"
                                        wire:model="otp_3" />
                                    <input class="input" type="text" inputmode="numeric" maxlength="1"
                                        wire:model="otp_4" />
                                </div>
                            </div>
                            @error('otp_1')
                            <p class="text-danger mt-2 fz-14px">{{ $message }}</p>
                            @enderror
                            @error('otp_2')
                            <p class="text-danger mt-2 fz-14px">{{ $message }}</p>
                            @enderror
                            @error('otp_3')
                            <p class="text-danger mt-2 fz-14px">{{ $message }}</p>
                            @enderror
                            @error('otp_4')
                            <p class="text-danger mt-2 fz-14px">{{ $message }}</p>
                            @enderror
                            <div class="text-center d-flex flex-column align-items-center">
                                <button class="btn btn-warning btn-lg btn-verifiy " type="button"
                                    wire:click="verifiy()">@lang('app.verify')</button>
                                <a class="fz-14px mt-4 text-dark text-decoration-none" href="javascript:void(0);"
                                    wire:loading.class="disabled" wire:click.prevent="resend">@lang('app.dident_recive_otp_message')</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script src="{{ asset('js/script.js') }}"> </script>
    @endpush
</div>
