<div class="container">
    <div class="pt-6rem mh-800px">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="auth-logo d-flex justify-content-center align-items-center flex-column mx-auto"
                    style="max-width:488px;">
                    <!-- <h1>{{ App::getLocale() }}</h1>; -->
                    <img src="{{ asset('images/logo.png') }}" alt="" width="60%;" />
                    <h2 class="mt-2 text-center">@lang('app.signup')</h2>
                    
                         <!-- start step bar -->
                        <div class="progress-bar">
                              <div class="step-circle completed" data-step="1">1</div>
                              <div class="step-circle completed" data-step="2">2</div>
                              <div class="step-circle completed" data-step="3">3</div>
                              <div class="step-circle step_active" data-step="4">4</div>
                        </div>
                        <!-- end step bar -->
                    <p class="text-center">@lang('app.enter_sent_otp_message') {{
                      authRegisterStep()->email }}
                    
                    <br>
                        @lang('app.becareful_nota_share_message')</p>
                        
                    <!--<p class="text-center">Step number (4/4)</p>-->
                </div>
                <div class="auth-inputs mt-3 mx-auto"
                    style="max-width: 488px; padding-left: 15px; padding-right: 15px;">
                    <form wire:submit.prevent="register" class="h-250px">
                      <div class="step-four xh-100 text-center">
                            @if (Session::has('success'))
                            <p class="text-success">@lang('app.otp_resent')</p>
                            @endif
                            <div class="input-group mb-4">
                                <div id="inputs" class="inputs">
                                    <input class="input" type="text" inputmode="numeric" maxlength="1" wire:model="otp_1" />
                                    <input class="input" type="text" inputmode="numeric" maxlength="1" wire:model="otp_2" />
                                    <input class="input" type="text" inputmode="numeric" maxlength="1" wire:model="otp_3" />
                                    <input class="input" type="text" inputmode="numeric" maxlength="1" wire:model="otp_4" />
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
                        </div>

                        <div class="d-flex justify-content-center">
                           <div class="text-center d-flex flex-column">
                                <button class="btn  btn-lg btn-register-verifiy bg-yellow" type="button"
                                    wire:click="register()">@lang('app.verify_email')</button>
                               <p   class="fz-15px mt-4 " >
                                    <!-- @lang('app.dident_recive_otp_message' ) -->
                                    Didn’t receive the OTP? 
                               <a class="fz-14px text-black text-decoration-none" href="javascript:void(0);"
                                    wire:click.prevent="resend">
                                     <span class="outline"> Click to resend</span></a>
                               </p>

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
    {{-- @endif --}}
</div>
