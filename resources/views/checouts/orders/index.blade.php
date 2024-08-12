
@extends('checouts.app-organization')
@section('content')


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.id')</strong></th>

                                    <th><strong>@lang('app.price')</strong></th>
                                    <th><strong>payment method</strong></th>
                                    <th><strong>payment status</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)

                                <tr>
                                    <td><strong>{{ $order->id }}</strong></td>

                                    <td>
                                      {{$order->total}}
                                    </td>
                                    <td>
                                        {{$order->payment_transaction->method}}
                                    </td>
                                    <td>
                                        {{$order->payment_transaction->status ==1 ? 'true' : 'false'}}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('checout.order.show',['order'=>$order->id]) }}"
                                                class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i></a>

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


</div>
@stop
