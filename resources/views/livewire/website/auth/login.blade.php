<div class="container">
    <div class="pt-6rem mh-800px">

        <div class="auth">

            <div class="auth-logo ">
                <img src="{{ asset('images/logo.png') }}" alt=""/>
                <h2 class="">@lang('app.sign_in')</h2>
                <p>@lang('app.signin_message')</p>
                @if (Session::has('success-reset-password'))
                    <p class="text-success">{{ Session::get('success-reset-password') }}</p>
                @endif
            </div>
            <div class="auth-inputs ">
                <form wire:submit.prevent="login" class="h-250px">
                    <!-- <div class="step-three xh-100"> -->
                    <div class="auth_inputs_group">
                        <div class="input-group ">
                            <div class="w-100 ">
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                       placeholder="email@organization.com" wire:model="state.email">
                            </div>
                            @error('email')
                            <p class="text-danger fz-14px mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class=" input-group">
                            <div class="position-relative w-100 ">
                                <input type="password" class="form-control" id="passwordInput"
                                       placeholder="@lang('app.password')"
                                       wire:model="state.password">
                                <span id="togglePassword" onclick="togglePasswordVisibility()"><i
                                        class="fa-regular fa-eye-slash"></i></span>
                            </div>
                            @error('password')
                            <p class="text-danger fz-14px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="auth_action">
                        <div class=" text-center">
                            <button class="btn btn-warning btn-lg x-w-like-input w-100 " type="button"
                                    wire:loading.attr="disabled" wire:click.prevent="login">@lang('app.login')</button>
                        </div>

                        <div class="remember-me-container ">
                            <div class="remember-me ">
                                <div class="forgat-password">
                                    <a href="https://edu.jawraa.com/files/User_guideline.pdf" target="_blank"
                                       class="outline">Download Registration Guide Line</a>
                                </div>
                            </div>
                            <div class="forgat-password">
                                <a href="{{ route('user.forgotpassword') }}"
                                   class="outline">@lang('app.forgot_password')? </a>
                            </div>
                        </div>

                    </div>

                    <div class=" text-center">
                        <div class="fz-16px">
                            @lang('app.signup_message')
                            <a class="sign_up" href="javascript:void(0);"
                               wire:loading.class="disabled"
                               wire:click.prevent="$dispatch('open-modal')">@lang('app.signup') ! </a>
                        </div>
                    </div>
                    <!-- </div> -->
                </form>
            </div>
        </div>
    </div>

    {{-- @if ($currentStep == 3) --}}
    @push('js')
        <script src="{{ asset('js/script.js') }}"></script>
    @endpush
    {{-- @endif --}}
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const togglePassword = document.getElementById('togglePassword');

        if (passwordInput.type === 'password') {
            passwordInput.type = '';
            togglePassword.innerHTML = '<i class="fa-regular fa-eye"></i>'
        } else {
            passwordInput.type = 'password';
            togglePassword.innerHTML = '<i class="fa-regular fa-eye-slash"></i>'
        }
    }
</script>
