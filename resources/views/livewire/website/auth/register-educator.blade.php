<div class="container">
    <div class="pt-6rem mh-800px">
        <div class="row justify-content-center">
            <div class="col-12  ">
                @php
                    $title     = 'title_'.config('app.locale');
                    $sub_title = 'sub_title_'.config('app.locale');
                    $content   = 'content_'.config('app.locale');
                @endphp
                    <!-- 30 / 3 fatma -->
                <div class="auth-logo d-flex justify-content-center align-items-center flex-column mx-auto" style="max-width: min(100%, 488px);">
                    <img src="{{ asset('images/logo.png') }}" alt="" width="60%;">
                    <h2 class="mt-2 text-center">@lang('app.sign_up')</h2>
                    <p class="text-center">@lang('app.register_message')</p>

                </div>
                <!-- 30 / 3 fatma -->
                <div class="auth-inputs mt-3 mx-auto"
                     style="max-width: min(100%, 488px); padding-left: 15px; padding-right: 15px;">
                    <form wire:submit.prevent="register" class="h-250px">
                        <!-- start step bar -->
                        <div class="progress-bar">
                            @for ($i = 1; $i <= 4; $i++)
                                <div class="step-circle {{ $i == $currentStepEducator ? 'step_active' : ($i < $currentStepEducator ? 'completed' : '') }}" data-step="{{ $i }}">{{ $i }}</div>
                            @endfor
                        </div>
                        <!-- end step bar -->

                        @if ($currentStepEducator == 1)
                            <div class="step-one xh-100">
                                {{-- <div class="input-group flex-column mb-3">
                                    <select class="form-select form-select-lg w-100" aria-label="Large select example"
                                        wire:model="user_type">
                                        <option>User Type</option>
                                        <option value="STUDENT">Student</option>
                                        <option value="TEACHER">Teacher</option>
                                    </select>
                                    @error('user_type')
                                    <p class="text-danger fz-14px">{{ $message }}</p>
                                    @enderror
                                </div> --}}
                                <div class="input-group flex-column mb-3">
                                    <select class="form-select form-select-lg w-100" aria-label="Large select example"
                                            wire:model.live="region_id">
                                        <option value="">@lang('app.region')</option>
                                        @forelse ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->translate('name') }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                    @error('region_id')
                                    <p class="text-danger fz-14px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input-group flex-column mb-3">
                                    <select class="form-select form-select-lg w-100" aria-label="Large select example"
                                            wire:model="city_id">
                                        <option value="">@lang('app.city')</option>
                                        @forelse ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->translate('name') }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                    @error('city_id')
                                    <p class="text-danger fz-14px">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        @if ($currentStepEducator == 2)
                            <div class="step-two xh-100">
                                <div class="input-group flex-column mb-3">
                                    <select class="form-select form-select-lg w-100" aria-label="Large select example"
                                            wire:model.live="role_id">
                                        <option value="">@lang('app.role')</option>
                                        @forelse ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->translate('name') }}
                                            </option>
                                        @empty

                                        @endforelse
                                    </select>
                                    @error('role_id')
                                    <p class="text-danger fz-14px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input-group flex-column mb-3">
                                    <select class="form-select form-select-lg w-100" aria-label="Large select example"
                                            wire:model="organization_id">
                                        <option value="">@lang('app.organization')</option>
                                        @forelse ($organizations as $organization)
                                            <option value="{{ $organization->id }}">{{ $organization->translate('name') }}
                                            </option>
                                        @empty

                                        @endforelse
                                    </select>
                                    @error('organization_id')
                                    <p class="text-danger fz-14px">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        @if ($currentStepEducator == 3)
                            <div class="step-three xh-100">
                                <div class="input-group mb-3 flex-column">
                                    <div class="w-100 d-flex ar-direction-ltr">
                                        <input type="text" class="form-control auth-email" aria-label=""
                                               aria-describedby="basic-addon2" wire:model="email">
                                        <span class="input-group-text auth-prefix" id="basic-addon2">@ {{
                                        $registerStepOrgnization->domain }}</span>
                                    </div>
                                    @error('email')
                                    <p class="text-danger fz-14px ml-0">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-group mb-3 flex-column">
                                    <div class="w-100 d-flex  position-relative">
                                        <input type="password" class="form-control" aria-label=""
                                               aria-describedby="basic-addon2" id="passwordInput" wire:model="password" placeholder="@lang('app.password')">

                                        <span id="togglePassword"  onclick="togglePasswordVisibility()"><i class="fa-regular fa-eye-slash"></i></span>
                                        {{-- <span class="input-group-text auth-prefix" id="basic-addon2">@ {{
                                            $registerStepOrgnization->domain }}</span> --}}
                                    </div>
                                    @error('password')
                                    <p class="text-danger fz-14px ml-0">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-flex">
                                    <div class="terms_accept"style="margin-bottom:10px">
                                        <input class="form-check-input"  type="checkbox" style="margin:0" id="acceptTerms" wire:model="terms" name="accept">
                                        <label class="form-check-label "  for="" > By clicking, you agree to Terms & Conditions <span onclick=appearTerms() class="outline" >outlined here.</span> </label>
                                    </div>

                                </div>
                                @error('terms')
                                <p class="text-danger fz-14px ml-0"> Continuing with this transaction implies your agreement to our Terms and Conditions. </p>
                                @enderror
                            </div>
                        @endif

                        @if ($currentStepEducator == 4)
                            <div class="step-four xh-100 text-center">
                                @if (Session::has('success'))
                                    <p class="text-success">OTP resent</p>
                                @endif
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
                            </div>
                        @endif

                        <div class="d-flex justify-content-center">
                            @if ($currentStepEducator == 4)
                                <div class="text-center d-flex flex-column">
                                    <button class="btn btn-outline-dark btn-lg" type="button" wire:click="register()">Verify
                                        Email</button>
                                    <a class="fz-14px mt-4 text-black text-decoration-none" href="javascript:void(0);"
                                       wire:click.prevent="resend">@lang('app.dident_recive_otp_message')</a>

                                </div>
                                {{-- @elseif ($currentStepEducator == 3)
                                <div class="mt-4 d-flex justify-content-center w-100">
                                    <button class="btn btn-outline-dark btn-lg" type="button"
                                        wire:click="increaseStep">Verify Email</button>
                                </div> --}}
                            @else
                                <div class="register mt-4" >
                                     @if ($currentStepEducator != 1)  
                                    <button style="background:lightgray" class="btn_register  btn  btn-back-in-register @if ($currentStepEducator == 3 || $currentStepEducator == 4)
                               @else
                               {{-- ml-30px --}}
                                @endif" type="button" wire:click="decreaseStep">@lang('app.back')</button>
                                     @endif 
                                    <button class="btn_register btn btn-warning  btn-back-in-register bg-yellow
                                @if ($currentStepEducator == 2 ||$currentStepEducator == 3 || $currentStepEducator == 4)
                                @else
                                m-auto
                                @endif
                                " type="button" wire:loading.attr="disabled" wire:click="increaseStep">@lang('app.next')</button>
                                </div>

                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- @if ($currentStepEducator == 3) --}}
    @push('js')
        <script src="{{ asset('js/script.js') }}"> </script>
    @endpush
    {{-- @endif --}}
    <!--start terms  -->
    <div class=" d-none" id="terms_popup">
        <!-- <div class="layout "></div> -->
        <!-- <div class="remove" onclick=removeTerms()>X</div> -->
        <div class="pop_up">
            <div class="pop_up_content">
                <div class="remove " style="" onclick=removeTerms()> <i class="fa fa-close " style=""></i></div>
 
                <div class="terms">
                    <div class="terms_body">
                        <div class="terms_header">
                            <h1> Terms & Conditions</h1>
                                    <img  src="{{ asset('assets/images/nav-logo.svg') }}" class="icon" alt=""/>
                             
                        </div>

                        <div class="body">
                            <p class="lastupdate"> Last Updated :  <span>[{{\Carbon\Carbon::parse(\App\Models\Term::orderBy('updated_at','desc')->value('updated_at'))->format('d/m/Y')}}]</span></p>


                            {!! getTerms() !!}

                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>
    <!--end terms  -->






</div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const togglePassword = document.getElementById('togglePassword');


        if(passwordInput.type === 'password'){
            passwordInput.type = '';
            togglePassword.innerHTML = '<i class="fa-regular fa-eye"></i>'
        }else{
            passwordInput.type = 'password';
            togglePassword.innerHTML = '<i class="fa-regular fa-eye-slash"></i>'
        }
    }
</script>
<script>

    let terms_Popup = document.getElementById('terms_popup');

    function appearTerms() {
        terms_popup.classList.remove('d-none')
    }

    function removeTerms() {
        terms_popup.classList.add('d-none')
    }
</script>
