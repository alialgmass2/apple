<div>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.users')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th><strong>ID</strong></th>
                                    <th><strong>Type</strong></th>
                                    {{-- <th><strong>Name</strong></th> --}}
                                    <th><strong>Email</strong></th>
                                    <th><strong>Education Level</strong></th>
                                    <th><strong>Organization</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)

                                <tr>
                                    <td><strong>{{ $user->id }}</strong></td>
                                    <td>{{ $user->user_type }}</td>
                                    {{-- <td>{{ $user->name }}</td> --}}
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->educationLevel->translate('name') }}</td>
                                    <td>{{ $user->organization->translate('name') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            {{-- <a href="#" class="btn btn-xs sharp me-1 text-primary fz-16px"
                                                wire:loading.class="disabled"
                                                wire:click.prevent="showModalEdit({{ $user->id }})"><i
                                                    class="fa-regular fa-pen-to-square"></i></a> --}}
                                                    <a href="{{ route('admin.user.show',[$user->id]) }}" class="btn btn-xs sharp text-warning fz-16px"><i
                                                                class="fa fa-eye" wire:loading.class="disabled"></i></a>

                                            <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $user->id }})"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')

    <script>
        document.addEventListener('livewire:initialized', () => {
                        @this.on('success', (event) => {
                            Swal.fire(
                            'Success',
                            "{!! __('app.data_deleted') !!}",
                            'success');
                        });
                    });
    </script>
    @endpush
</div>
