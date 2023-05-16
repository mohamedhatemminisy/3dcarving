@extends('layouts.admin')
<style>
    .hidden-column {
      display: none;
    }
  </style>
@section('content')


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> {{trans('admin.orders')}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> {{trans('admin.home')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item"> {{trans('admin.orders')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> {{trans('admin.orders')}} </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('dashboard.includes.alerts.success')
                            @include('dashboard.includes.alerts.errors')

                            <div class="card-body card-dashboard" style="width: 100%; overflow-x: auto;">
                                <div class="table-responsive">
                                  <table class="table display nowrap table-striped table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th> {{trans('admin.code')}} </th>
                                                <th> {{trans('admin.created_at')}} </th>
                                                <th> {{trans('admin.action')}}</th>
                                                <th> {{trans('admin.operations')}}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $key => $value)
                                            <tr>
                                                <td>{{ $value->code }}</td>
                                                <td>{{ $value->created_at->format('jS F Y h:i:s A')}}</td>
                                                <td>
                                                    @include('dashboard.components.table-control', ['permission' =>
                                                    'orders',
                                                    'name'=>'orders', 'value'=>$value])
                                                </td>
                                                <td>
                                                    @can('orders.status')
                                                    <button type="button" class="btn btn-primary btn-lg"
                                                        data-toggle="modal" data-target="#order_status-{{ $key+1 }}">
                                                        {{trans('admin.order_status')}}
                                                    </button>
                                                    @endcan
                                                    <!-- Button trigger modal -->
                                                    @can('orders.price')
                                                    <button type="button" class="btn btn-primary btn-lg"
                                                        data-toggle="modal" data-target="#myModal-{{ $key+1 }}">
                                                        {{trans('admin.price')}}
                                                    </button>
                                                    @endcan
                                                    @can('orders.pricing_status')
                                                    <button type="button" class="btn btn-primary btn-lg"
                                                        data-toggle="modal" data-target="#pricing_status-{{ $key+1 }}">
                                                        {{trans('admin.pricing_status')}}
                                                    </button>
                                                    @endcan

                                                    @can('orders.designer')
                                                    <button type="button" class="btn btn-primary btn-lg"
                                                        data-toggle="modal" data-target="#designer_modal-{{ $key+1 }}">
                                                        {{trans('admin.designer')}}
                                                    </button>
                                                    @endcan

                                                    @can('orders.design_status')
                                                    <button type="button" class="btn btn-primary btn-lg"
                                                        data-toggle="modal" data-target="#design_status-{{ $key+1 }}">
                                                        {{trans('admin.design_status')}}
                                                    </button>
                                                    @endcan
                                                    @can('orders.accountant')
                                                    <button type="button" class="btn btn-primary btn-lg"
                                                        data-toggle="modal" data-target="#accountant_modal-{{ $key+1 }}">
                                                        {{trans('admin.accountant')}}
                                                    </button>
                                                    @endcan
                                                    @can('orders.material')
                                                    <button type="button" class="btn btn-primary btn-lg"
                                                        data-toggle="modal" data-target="#material_modal-{{ $key+1 }}">
                                                        {{trans('admin.material')}}
                                                    </button>
                                                    @endcan
                                                    @can('orders.operation_status')
                                                    <button type="button" class="btn btn-primary btn-lg"
                                                        data-toggle="modal" data-target="#operation_status_modal-{{ $key+1 }}">
                                                        {{trans('admin.operation_status')}}
                                                    </button>
                                                    @endcan
                                                    @can('orders.machine')
                                                    <button type="button" class="btn btn-primary btn-lg"
                                                        data-toggle="modal" data-target="#machine-{{ $key+1 }}">
                                                        {{trans('admin.machine')}}
                                                    </button>
                                                    @endcan
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">
                                        {{ $orders->links('vendor.pagination.custom') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach($orders as $key => $value)

<div class="modal fade" id="order_status-{{  $key+1 }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin.order_status')}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ Route('order.status',$value->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="{{ $value->id }}">
                        <label for="price">{{trans('admin.order_status')}}:</label>
                        <select name="status" class="form-control">
                            <option disabled selected> @lang('admin.select')</option>
                            <option value="hold" @if($value->status ==
                                'hold') selected @endif>
                                hold</option>
                            <option value="waiting_for_details" @if($value->status ==
                                'waiting_for_details') selected @endif >Waiting for details</option>
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('admin.order_status')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal-{{  $key+1 }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin.updatePrice')}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ Route('update.price',$value->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="{{ $value->id }}">
                        <label for="price">{{trans('admin.updatePrice')}}:</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $value->price }}">
                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('admin.updatePrice')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pricing_status-{{  $key+1 }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin.pricing_status')}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ Route('update.price.status',$value->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="{{ $value->id }}">
                        <label for="price">{{trans('admin.pricing_status')}}:</label>
                        <select name="pricing_status" class="form-control">
                            <option disabled selected> @lang('admin.select')</option>
                            <option value="approved" @if($value->pricing_status ==
                                'approved') selected @endif>
                                approved</option>
                            <option value="rejected" @if($value->pricing_status ==
                                'rejected') selected @endif >rejected</option>
                            <option value="waiting_for_approval" @if($value->pricing_status ==
                                'waiting_for_approval') selected @endif>
                                waiting for approval</option>
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('admin.pricing_status')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>
 
<div class="modal fade" id="designer_modal-{{  $key+1 }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin.designer')}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ Route('order.designer',$value->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="{{ $value->id }}">
                        <label for="designer">{{trans('admin.designer')}}:</label>
                        <select name="designer" class="form-control">
                            <option disabled selected> @lang('admin.select')</option>
                          
                            @if($designers && $designers -> count() > 0)
                            @foreach($designers as $designer)
                            <option value="{{$designer -> id }}" @if($value->designer_id == $designer->id) selected @endif>{{$designer -> name}}</option>
                            @endforeach
                            @endif
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('admin.designer')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>
 
<div class="modal fade" id="design_status-{{  $key+1 }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin.design_status')}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ Route('update.design.status',$value->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="{{ $value->id }}">
                        <label for="design">{{trans('admin.design_status')}}:</label>
                        <select name="design_status" class="form-control">
                            <option disabled selected> @lang('admin.select')</option>
                            <option value="compeleted" @if($value->design_status ==
                                'compeleted') selected @endif>
                                Compeleted</option>
                            <option value="in_progress" @if($value->design_status ==
                                'in_progress') selected @endif >In Progress</option>
                            <option value="hold" @if($value->design_status ==
                                'hold') selected @endif>
                                Hold</option>
                            <option value="waiting_for_materials" @if($value->design_status ==
                                    'waiting_for_materials') selected @endif>
                                    Waiting for materials</option>
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('admin.design_status')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="accountant_modal-{{  $key+1 }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin.accountant')}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ Route('order.accountant',$value->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="{{ $value->id }}">
                        <label for="accountant">{{trans('admin.accountant')}}:</label>
                        <select name="accountant" class="form-control">
                            <option disabled selected> @lang('admin.select')</option>
                          
                            @if($accountants && $accountants -> count() > 0)
                            @foreach($accountants as $accountant)
                            <option value="{{$accountant -> id }}" @if($value->accountant_id == $accountant->id) selected @endif>{{$accountant -> name}}</option>
                            @endforeach
                            @endif
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('admin.accountant')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="material_modal-{{  $key+1 }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin.material')}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ Route('order.material',$value->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="{{ $value->id }}">
                        <label for="thickness">{{trans('admin.thickness')}}:</label>
                        <input type="text" class="form-control" id="thickness" name="thickness" value="{{$value->OrderMaterial ? $value->OrderMaterial->thickness : '' }}">
                        <label for="type">{{trans('admin.type')}}:</label>
                        <input type="text" class="form-control" id="type" name="type" value="{{$value->OrderMaterial ? $value->OrderMaterial->type : '' }}">
                        <label for="height">{{trans('admin.height')}}:</label>
                        <input height="text" class="form-control" id="height" name="height" value="{{$value->OrderMaterial ? $value->OrderMaterial->height : '' }}">
                        <label for="width">{{trans('admin.width')}}:</label>
                        <input width="text" class="form-control" id="width" name="width" value="{{$value->OrderMaterial ? $value->OrderMaterial->width : '' }}">
                        <label for="status">{{trans('admin.status')}}:</label>
                        <select name="status" class="form-control">
                            <option disabled selected> @lang('admin.select')</option>
                            <option value="internal" {{ $value->OrderMaterial && $value->OrderMaterial->status == 'internal' ? 'selected' : '' }}>
                                internal
                            </option>
                            <option value="received" {{ $value->OrderMaterial && $value->OrderMaterial->status == 'received' ? 'selected' : '' }}>
                                received
                            </option>
                            <option value="not_received" {{ $value->OrderMaterial && $value->OrderMaterial->status == 'not_received' ? 'selected' : '' }}>
                                Not Received
                            </option>
                        </select>
                        
                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('admin.material')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="operation_status_modal-{{  $key+1 }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin.operation_status')}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ Route('update.operation.status',$value->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="{{ $value->id }}">
                        <label for="design">{{trans('admin.operation_status')}}:</label>
                        <select name="operation_status" class="form-control operation_status">
                            <option disabled selected> @lang('admin.select')</option>
                            <option value="compeleted" @if($value->operation_status ==
                                'compeleted') selected @endif>
                                Compeleted</option>
                            <option value="in_progress" @if($value->operation_status ==
                                'in_progress') selected @endif >In Progress</option>
                            <option value="hold" @if($value->operation_status ==
                                'hold') selected @endif>
                                Hold</option>
                            <option value="in_turn" @if($value->operation_status ==
                                    'in_turn') selected @endif>
                                    In Turn</option>
                        </select>
                        <div id="hold" class="hold d-none">
                            <label for="operation_hold_reason">{{trans('admin.operation_hold_reason')}}:</label>
                            <input type="text" class="form-control" id="operation_hold_reason" name="operation_hold_reason" value="{{ $value->operation_hold_reason }}">
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('admin.operation_status')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="machine-{{  $key+1 }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin.machine')}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ Route('order.machine',$value->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="{{ $value->id }}">
                        <label for="machine">{{trans('admin.machine')}}:</label>
                        <select name="machine" class="form-control">
                            <option disabled selected> @lang('admin.select')</option>
                          
                            @if($machines && $machines -> count() > 0)
                            @foreach($machines as $machine)
                            <option value="{{$machine -> id }}" @if($value->machine_id == $machine->id) selected @endif>{{$machine -> name}}</option>
                            @endforeach
                            @endif
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('admin.machine')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>


@endforeach
@stop

@section('script')
    <script>

$('.operation_status').on('change', function()
    {
        var form = $(this);
        var type = form.val();
        if(type == 'hold')
        {
            $('.hold').removeClass("d-none");
        }
        if(type == 'compeleted')
        {
            $('.hold').addClass("d-none");
        }
        if(type == 'in_progress')
        {
            $('.hold').addClass("d-none");
        }
        if(type == 'in_turn')
        {
            $('.hold').addClass("d-none");
        }
    });

</script>

@endsection
