<div class="container">
    <div class="pt-6rem mh-800px">
        <div class="row justify-content-center">
            <div class="col-12 d-flex flex-column align-items-center">

                <div class="auth-logo d-flex justify-content-center align-items-center flex-column mx-auto" style="max-width: 488px;">
                    <img src="{{ asset('images/logo.png') }}" alt="" style="width: 60%;" />
                    <h2 class="mt-2 text-center">@lang('app.forgot_password_otp')</h2>
                    <p class="text-center">@lang('app.enter_otp_to_reset_password')</p>
                    @if (Session::has('success'))
                    <p class="text-success">{{ Session::get('success') }}</p>
                    @endif
                </div>
                <div class="auth-inputs mt-3">
                    <form wire:submit.prevent="login" class="h-250px">
                        <div class="step-three xh-100 d-flex flex-column align-items-center">
                            <div class="input-group mb-3">
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
                            <p class="text-danger mt-2 fz-14px mb-3">{{ $message }}</p>
                            @enderror
                            @error('otp_2')
                            <p class="text-danger mt-2 fz-14px mb-3">{{ $message }}</p>
                            @enderror
                            @error('otp_3')
                            <p class="text-danger mt-2 fz-14px mb-3">{{ $message }}</p>
                            @enderror
                            @error('otp_4')
                            <p class="text-danger mt-2 fz-14px mb-3">{{ $message }}</p>
                            @enderror
                            {{-- <div class="input-group mb-4 flex-column">
                                <div class="w-100 d-flex justify-content-center">
                                    <input type="password" class="form-control" id="exampleFormControlInput1"
                                        placeholder="New Password" wire:model="password">
                                </div>
                                @error('password')
                                <p class="text-danger mt-2 fz-14px ms-0 text-left" style="margin-left: 0 !important;">{{
                                    $message }}</p>
                                @enderror
                            </div> --}}
                            <div class="text-center d-flex flex-column align-items-center">
                                <button class="btn btn-warning btn-lg btn-verifiy " type="button"
                                    wire:click="resetPassword()">@lang('app.reset')</button>
                                <a class="fz-14px mt-4 text-dark  text-decoration-none" href="javascript:void(0);"
                                    wire:loading.class="disabled" wire:click.prevent="resend">@lang('app.dident_recive_otp_message')</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- @if ($currentStep == 3) --}}
    @push('js')
    <script src="{{ asset('js/script.js') }}"> </script>
    @endpush
    {{-- @endif --}}
</div>
