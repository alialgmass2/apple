@props(['isModalShow','title','size' => '',])
<div class="modal {{ $size }} fade show {{ $isModalShow ? 'modal-bg d-block' : '' }}" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-start position-relative border-0">
                @if (Route::is('user.organization.product'))
                <button type="button" class="btn-close fz-14px" data-bs-dismiss="modal" wire:click.prevent="closeModalOrder">
                </button>
                @elseif(Route::is('website.register.student') || Route::is('website.register.educator'))
                <button type="button" class="btn-close fz-14px" data-bs-dismiss="modal" wire:click.prevent="closeModalMailExists">
                </button>
                @else
                <button type="button" class="btn-close fz-14px" data-bs-dismiss="modal" wire:click.prevent="closeModal">
                </button>
                @endif

            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
