<div>

    <!-- START OUR GET IN TOUCH -->
    <section id="get-in-touch-id" class="getInTouch @if ($isModalContactShow)
        padding-0
    @endif ">
        <h2 class="getInTouch_head @if ($isModalContactShow)
    hide
    @else
     display-block
@endif
        ">@lang('app.get_in_touch')</h2>
        <button class="getInTouch_button @if ($isModalContactShow)
    hide
    @else
    display-flex
@endif " wire:loading.class="disabled" wire:click.prevent="openContactModal">@lang('app.contact_us')</button>
        <!-- start contact  -->
        <div id="parent" class="@if ($isModalContactShow)
    show-contact
    @else
    hide-contact
@endif">

            <div class="parent">
                <div id="close-icon" onclick="closeContact()">
                    <img src="{{ asset('assets/images/close-icon.svg') }}" alt="" srcset="">
                </div>

                <div class="content-contact">
                    <div class="title">
                        <p>@lang('app.contact_us')</p>
                    </div>
                    <div class="form">
                        @if ($errors->any())
                        <li class="text-red">@lang('app.contact_validation_message')</li>
                        <br>
                        @endif
                        @if (Session::has('success'))
                        <li class="text-green">{{ Session::get('success') }}</li>
                        @endif
                        <form action="">
                            <div class="from-content">
                                <input type="text" name="name" id="" class="@error('name')
                                        border-red
                                    @enderror" placeholder="@lang('app.placeholder_name')" wire:model="state.name">

                                <input type="email" name="email" class="@error('email')
                                        border-red
                                    @enderror" id="" placeholder="@lang('app.placeholder_email')" wire:model="state.email">

                                <div class="select  @error('role_id')
                                                                            border-red
                                                                        @enderror">
                                    <select wire:model="state.role_id" class="role-select">
                                        <option value="">@lang('app.roles')</option>
                                        @forelse ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->translate('name') }}</option>
                                        @empty

                                        @endforelse

                                    </select>
                                </div>

                                <input id="" type="text" class="@error('institution')
                                                                        border-red
                                                                    @enderror" placeholder="@lang('app.placeholder_institution')"
                                    wire:model="state.institution">

                                <input type="tel" name="mobile" class="@error('phone')
                                        border-red
                                    @enderror" id="" placeholder="@lang('app.placeholder_mobile')" pattern="[0-9]{11}"
                                    wire:model="state.phone">

                                <textarea name="message_details" class="@error('message')
                                        border-red
                                    @enderror" id="" placeholder="@lang('app.placeholder_message')*"
                                    wire:model="state.message"></textarea>

                            </div>
                            <button type="button" class="button" wire:click.prevent="sendMessage"><span class="show"
                                    wire:loading.attr="disabled">@lang('app.send_message')</span>
                                <div class="spinner hide"></div>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- end contact  -->
    </section>
    <!-- END OUR GET IN TOUCH -->
</div>
