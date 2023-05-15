@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('admin.orders')}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('admin.home')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{trans('admin.orders')}}
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

                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="col form-group">
                                        <label>@lang('admin.code') </label>
                                        <p class="alert">
                                            {{ $order->code  }}
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.description') </label>
                                        <p>
                                            {!! $order->description  !!}
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.added_by') </label>
                                        <p class="alert">
                                            {{ $order->user->name  }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.customer') </label>
                                        <p class="alert">
                                            {{ $order->customer->name  }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.status') </label>
                                        <p class="alert">
                                            {{ $order->status  }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.price') </label>
                                        <p class="alert">
                                            {{ $order->price  }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.unit') </label>
                                        @if($order->unit_id)
                                        <p class="alert">
                                            {{$order->unit->name}}
                                        </p>
                                        @endif
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.pricing_status') </label>
                                        <p class="alert">
                                            {{ $order->pricing_status  }}
                                        </p>
                                    </div><hr>
                
                                    <div class="col form-group">
                                        <label>@lang('admin.price_approved_at') </label>
                                        @if($order->price_approved_at)
                                        <p class="alert">
                                            {{$order->price_approved_at}}
                                        </p>
                                        @endif
                                    </div><hr>
                                    
                                    <div class="col form-group">
                                        <label>@lang('admin.designer') </label>
                                        <p class="alert">
                                            @if($order->designer_id)
                                            {{ $order->designer->name  }}
                                            @endif
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.design_status') </label>
                                        <p class="alert">
                                            {{ $order->design_status  }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.design_start_at') </label>
                                        @if($order->design_start_at)
                                        <p class="alert">
                                            {{$order->design_start_at}}
                                        </p>
                                        @endif
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.accountant') </label>
                                        <p class="alert">
                                            @if($order->accountant_id)
                                            {{ $order->accountant->name  }}
                                            @endif
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.design_compelete_at') </label>
                                        @if($order->design_compelete_at)
                                        <p class="alert">
                                            {{$order->design_compelete_at}}
                                        </p>
                                        @endif
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.operation_status') </label>
                                        <p class="alert">
                                            {{ $order->operation_status  }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.operation_hold_reason') </label>
                                        <p class="alert">
                                            {{ $order->operation_hold_reason  }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.machine_type') </label>
                                        <p class="alert">
                                            @if($order->machine_type_id)
                                            {{ $order->machine_type->name  }}
                                            @endif
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.machine') </label>
                                        <p class="alert">
                                            @if($order->machine_id)
                                            {{ $order->machine->name  }}
                                            @endif
                                        </p>
                                    </div><hr>
                                    @if($order->files)
                                    <div class="col form-group">
                                        <label>@lang('admin.files') </label>
                                        <p>
                                            @foreach($order->files as $file)
                                            <img src="{{asset($file->file)}}" style="width:200px;height:200px;cursor:pointer" onclick="window.open('{{ asset($file->file) }}')">
                                            @endforeach
                                        </p>
                                    </div>
                                    @endif
                                    <hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.thickness') </label>
                                        <p class="alert">
                                            {{$order->OrderMaterial ? $order->OrderMaterial->thickness : '' }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.type') </label>
                                        <p class="alert">
                                            {{$order->OrderMaterial ? $order->OrderMaterial->type : '' }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.height') </label>
                                        <p class="alert">
                                            {{$order->OrderMaterial ? $order->OrderMaterial->height : '' }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.width') </label>
                                        <p class="alert">
                                            {{$order->OrderMaterial ? $order->OrderMaterial->width : '' }}
                                        </p>
                                    </div><hr>
                                    <div class="col form-group">
                                        <label>@lang('admin.status') </label>
                                        <p class="alert">
                                            {{$order->OrderMaterial ? $order->OrderMaterial->status : '' }}
                                        </p>
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
@stop