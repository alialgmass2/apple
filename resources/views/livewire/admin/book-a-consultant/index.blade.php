<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.book_a_consulation')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.book_a_consulation')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card"> 
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.id')</strong></th>
                                    <th><strong>@lang('app.name')</strong></th>
                                    <th><strong>@lang('app.email')</strong></th>
                                    <th><strong>@lang('app.phone')</strong></th>
                                    <th><strong>@lang('app.role')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $key => $contact)

                                <tr>
                                    <td><strong>{{ ++$key }}</strong></td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->role->translate('name') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('admin.bookaconsulation.show',[$contact->id]) }}"
                                                class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i></a>
                                            {{-- <a href="#" class="btn btn-xs sharp me-1 text-primary fz-16px"
                                                wire:loading.class="disabled"
                                                wire:click.prevent="showModalEdit({{ $contact->id }})"><i
                                                    class="fa-regular fa-pen-to-square"></i></a> --}}
                                            <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $contact->id }})"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>



</div>
