<div id="page">
    <!-- Strat Landing Page -->
    @livewire('website.components.education-banner')
    <!-- End Landing Page -->

    <!-- START OUR CUSTOMIZED -->
    @livewire('website.components.solutions')
    <!-- END OUR CUSTOMIZED -->


    <!-- START OUR DEPLOYMENT services -->
    @livewire('website.components.services')
    <!-- START OUR CUSTOMIZED -->
    @livewire('website.components.technical')
    <!-- END OUR CUSTOMIZED -->



    <!-- END OUR DEPLOYMENT services -->

    <!-- START OUR DEPLOYMENT services -->
    @livewire('website.components.cards-section-with-icon')

    <!-- END OUR DEPLOYMENT services -->


    <!-- START OUR START TO LEARN NEW CREATIVE SKILLS -->
    {{-- <section class="StartToLearnNewCreative">
        <h2 class="StartToLearnNewCreative_head">
            Start to Learn New Creative Skills
        </h2>
        <button class="StartToLearnNewCreative_button" wire:loading.attr="disabled" wire:click.prevent="toLogin">Sign
            In</button>
    </section> --}}
    <!-- END OUR START TO LEARN NEW CREATIVE SKILLS -->


    <!-- START OUR GET IN TOUCH -->
    @livewire('website.components.i-t-contact')
    <!-- END OUR GET IN TOUCH -->
</div>
