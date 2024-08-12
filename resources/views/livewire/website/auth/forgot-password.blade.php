<div class="container">
    <div class="pt-6rem mh-800px"> 
            <div class="col-12 ">


                <div class="auth-logo d-flex justify-content-center align-items-center flex-column mx-auto"
                    style="max-width: min(100%, 488px);">
                    <img src="{{ asset('images/logo.png') }}" alt="" />
                    <h2 class="mt-2">@lang('app.forgot_password')</h2>
                    <p class="text-center">@lang('app.enter_email_message')</p>
                </div>
                <div class="auth-inputs mt-3 mx-auto"
                    style="max-width:  min(100%, 488px); padding-left: 15px; padding-right: 15px;">
                    <form wire:submit.prevent="login" class="h-250px">
                        <div class="step-three xh-100">
                            <div class="input-group mb-3 flex-column">
                                <div class="w-100 d-flex justify-content-center">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="email@organization.com" wire:model="state.email">
                                </div>
                                @error('email')
                                <p class="text-danger fz-14px">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4 text-center">
                                <button class="btn btn-warning btn-lg w-like-input " type="button"
                                    wire:loading.attr="disabled" wire:click.prevent="login">@lang('app.send')</button>
                            </div>
                            <div class="mt-4 d-flex justify-content-between align-items-center fz-16px">

                            </div>
                            <div class="mt-4 text-center">
                                <div class="fz-16px ">
                                    @lang('app.signup_message') <a class="sign_up" href="javascript:void(0);"
                                                                   wire:loading.class="disabled" wire:click.prevent="$dispatch('open-modal')">@lang('app.signup')</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
    </div>

    {{-- @if ($currentStep == 3) --}}
    @push('js')
    <script src="{{ asset('js/script.js') }}"> </script>
    @endpush
    {{-- @endif --}}
</div>
