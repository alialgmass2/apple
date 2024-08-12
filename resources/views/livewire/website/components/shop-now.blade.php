<div>
    <div class="about min-height-350px">
        <div class="container">
            <p class="about-desc" style="margin-bottom:2rem;">{{ $learnShopNow->translate('text') }}</p>
            <a class="getInTouch_button" wire:loading.attr="disabled"
                href="{{ route('user.organization.organizations') }}">@lang('app.shop_now')</a>
        </div>
    </div>
</div>
