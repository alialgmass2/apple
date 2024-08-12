@props(['isModalShow','isEditMode','title'])
<div class="modal fade show {{ isset($isModalShow) && $isModalShow  ? 'modal-bg d-block' : '' }}" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-start position-relative">
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click.prevent="closeModal">
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 col-lg-12">
                    @if(isset($isModalHeader))
                        <h5 class="text-center mb-4">@lang('app.editHeader') @lang("app.{$title}")</h5>
                    @elseif (isset($isEditMode) && $isEditMode)
                        <h5 class="text-center mb-4">@lang('app.edit') @lang("app.{$title}")</h5>
                    @else
                    <h5 class="text-center mb-4">@lang('app.add') @lang('app.new') @lang("app.{$title}")</h5>
                    @endif
                </div>
                {{ $slot }}
            </div>
            <div class="modal-footer justify-content-between border-0">
                {{ $buttons }}
            </div>
        </div>
    </div>
</div>
