<div>
    <div class="cards_code">
        <div class="container">
            <div class="cards_code-header">
                <h3>@lang('app.learning_content_series')</h3>
            </div>
            <div class="cards_code-cards">
                @forelse ($onlineCourses as $onlineCourse)
                <div class="cards_code-learn">
                    <div class="cards_code-card_img">
                        <img src="{{ $onlineCourse->getFile() }}" alt="@lang('app.alt_image')" />
                    </div>
                    <div class="cards_code-card_content">
                        <div class="cards_code-card_content-text-1">
                            <p>{{ $onlineCourse->translate('title') }}</p>
                        </div>
                        <div class="cards_code-card_content-text-2">
                            <p>{{ $onlineCourse->translate('title_2') }}</p>
                        </div>
                        <div class="cards_code-card_content-button">
                            <button wire:loading.attr="disabled" wire:click.prevent="toLogin">@lang('app.start_training')</button>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse

            </div>

            <div class="popup_course">
                <div class="popup_course-body">
                    <div class="popup_course-body_header">
                        <h5>Welcome</h5>
                        <p>Please choose user type</p>
                    </div>
                    <div class="popup_course-body_buttons">
                        <button type="button">Student</button>
                        <p>Or</p>
                        <button type="button">Educator</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
{{-- OLD --}}
    {{-- <div class="cards_code">
        <div class="container">
            <div class="cards_code-header">
                <h3>Find the perfect online courses for you</h3>
            </div>
            <div class="cards_code-cards">
                @forelse ($onlineCourses as $onlineCourse)
                <div class="cards_code-learn">
                    <div class="cards_code-card_img">
                        <img src="{{ $onlineCourse->getFile() }}" alt="" />
                    </div>
                    <div class="cards_code-card_content">
                        <div class="cards_code-card_content-text-1">
                            <p>{{ $onlineCourse->translate('title') }}</p>
                        </div>
                        <div class="cards_code-card_content-text-2">
                            <p>{{ $onlineCourse->translate('title_2') }}</p>
                        </div>
                        <div class="cards_code-card_content-button">
                            <button wire:loading.attr="disabled" wire:click.prevent="toLogin">Start Training</button>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse

            </div>
            <div class="popup_course">
                <div class="popup_course-body">
                    <div class="popup_course-body_header">
                        <h5>Welcome</h5>
                        <p>Please choose user type</p>
                    </div>
                    <div class="popup_course-body_buttons">
                        <button type="button">Student</button>
                        <p>Or</p>
                        <button type="button">Educator</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
