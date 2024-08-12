<div class="container">
    <div class="pt-6rem mh-800px">
        <div class="row justify-content-center">
            <div class="col-12 ">

                <div class="auth-logo d-flex justify-content-center align-items-center flex-column mx-auto" style="max-width: 488px;">
                    <img style="width: 60%;" src="{{ asset('images/logo.png') }}" alt="" />
                    <h2 class="mt-2 text-center">@lang('app.forgot_password_otp')</h2>
                    <p class="text-center">@lang('app.enter_otp_to_reset_password')</p>
                    @if (Session::has('success'))
                    <p class="text-success">{{ Session::get('success') }}</p>
                    @endif
                </div>
                <div class="auth-inputs mt-3 mx-auto" style="max-width: 488px; padding-left: 15px; padding-right: 15px;">
                    <form wire:submit.prevent="login" class="h-250px">
                        <div class="step-three xh-100 d-flex flex-column align-items-center">

                            <div class="input-group mb-4 flex-column">
                                <div class="w-100 d-flex justify-content-center position-relative">
                                    <input type="password" class="form-control" id="passwordInput"
                                        placeholder="@lang('app.new_password')" wire:model="state.password">
                                          <span class="togglePassword"    onclick="togglePasswordVisibility(this)"><i class="fa-regular fa-eye-slash"></i></span>
                                </div>
                                @error('password')
                                <p class="text-danger mt-2 fz-14px ms-0 text-left" style="margin-left: 0 !important;">{{
                                    $message }}</p>
                                @enderror
                            </div>
                            <div class="input-group mb-4 flex-column">
                                <div class="w-100 d-flex justify-content-center position-relative">
                                    <input type="password" class="form-control" id="exampleFormControlInput1"
                                        placeholder="@lang('app.re_new_password')" wire:model="state.password_confirmation">
                                          <span  class="togglePassword"    onclick="togglePasswordVisibility(this)"><i class="fa-regular fa-eye-slash"></i></span>
                                </div>
                                @error('password_confirmation')
                                <p class="text-danger mt-2 fz-14px ms-0 text-left" style="margin-left: 0 !important;">{{
                                    $message }}</p>
                                @enderror
                            </div>
                            <div class="text-center d-flex flex-column align-items-center w-100">
                                <button class="btn btn-warning btn-lg w-100 " type="button"
                                    wire:click="resetPasswordNow()">@lang('app.reset')</button>
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
<script>
function togglePasswordVisibility(event) {
  const togglePassword = event; 
  const passwordContainer = (togglePassword).parentElement;
  const passwordInput = passwordContainer.querySelector('input');

  passwordInput.type = passwordInput.type === 'password' ? '' : 'password';
  togglePassword.innerHTML = passwordInput.type === 'password' ? '<i class="fa-regular fa-eye-slash"></i>' : '<i class="fa-regular fa-eye"></i>';
}
</script> 

