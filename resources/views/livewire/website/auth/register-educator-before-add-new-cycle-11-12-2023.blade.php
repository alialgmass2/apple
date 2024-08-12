<div class="container">
    <div class="pt-6rem mh-800px">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 bg-white">

                <div class="auth-logo d-flex justify-content-center align-items-center flex-column">
                    <img src="{{ asset('images/logo.png') }}" alt="" />
                    <h2 class="mt-2">Sign up</h2>
                    @if ($currentStepEducator == 1)
                    <p>Sign up to create Apple education account</p>
                    <p>Step number (1/4)</p>
                    @elseif ($currentStepEducator == 2)
                    <p>Sign up to create Apple education account</p>
                    <p>Step number (2/4)</p>
                    @elseif ($currentStepEducator == 3)
                    <p>Sign up to create Apple education account</p>
                    <p>Step number (3/4)</p>
                    @elseif ($currentStepEducator == 4)
                    <p class="text-center">Enter the OTP code that we sent to your emails {{
                        mb_substr($registerStepData->email,0,4) }}****@ {{ $registerStepData->organization->domain }}
                        Be careful not to share the code with anyone</p>
                    <p>Step number (4/4)</p>
                    @else
                    {{-- DO NOTHING --}}
                    @endif
                </div>
                <div class="auth-inputs mt-3">
                    <form wire:submit.prevent="register" class="h-250px">
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
                                    <option value="">Region</option>
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
                                    <option value="">City</option>
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
                                    <option value="">@lang('app.roles')</option>
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
                                    <option value="">Organization</option>
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
                                <div class="w-100 d-flex">
                                    <input type="text" class="form-control auth-email" placeholder="" aria-label=""
                                        aria-describedby="basic-addon2" wire:model="email">
                                    <span class="input-group-text auth-prefix" id="basic-addon2">@ {{
                                        $registerStepData->organization->domain }}</span>
                                </div>
                                @error('email')
                                <p class="text-danger fz-14px">{{ $message }}</p>
                                @enderror
                            </div>
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
                                    wire:click.prevent="resend">Didn’t receive the OTP? Click to
                                    resend</a>

                            </div>
                            {{-- @elseif ($currentStepEducator == 3)
                            <div class="mt-4 d-flex justify-content-center w-100">
                                <button class="btn btn-outline-dark btn-lg" type="button"
                                    wire:click="increaseStep">Verify Email</button>
                            </div> --}}
                            @else
                            <div class="mt-4 d-flex justify-content-between w-100 align-items-center">
                                {{-- @if ($currentStepEducator != 1) --}}
                                <button class="btn btn-outline-light btn-lg @if ($currentStepEducator == 3 || $currentStepEducator == 4)
                               @else
                               ml-30px
                                @endif" type="button" wire:click="decreaseStep">Back</button>
                                {{-- @endif --}}
                                <button class="btn btn-outline-dark btn-lg ms-auto
                                @if ($currentStepEducator == 3 || $currentStepEducator == 4)
                                @else
                                mr-30px
                                @endif
                                " type="button" wire:loading.attr="disabled" wire:click="increaseStep">Next</button>
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
</div>
