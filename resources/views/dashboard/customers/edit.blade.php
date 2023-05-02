@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> {{trans('admin.home')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('customers.index')}}"> {{trans('admin.customers')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active"> {{trans('admin.edit')}} - {{$customer -> name}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> {{trans('admin.edit')}} - {{$customer -> name}} </h4>
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
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form method="post" action="{{ route('customers.update', $customer->id) }}">
                                        @method('patch')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{trans('admin.name')}}</label>
                                            <input value="{{ $customer->name }}" type="text" class="form-control" name="name" placeholder="Name" required>

                                            @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{trans('admin.email')}}</label>
                                            <input value="{{ $customer->email }}" type="email" class="form-control" name="email" placeholder="Email address" required>
                                            @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">{{trans('admin.phone')}}</label>
                                            <input value="{{ $customer->phone }}" type="text" class="form-control" name="phone" placeholder="phone" required>
                                            @if ($errors->has('phone'))
                                            <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="whatsapp" class="form-label">{{trans('admin.whatsapp')}}</label>
                                            <input value="{{ $customer->whatsapp }}" type="text" class="form-control" name="whatsapp" placeholder="whatsapp" required>
                                            @if ($errors->has('whatsapp'))
                                            <span class="text-danger text-left">{{ $errors->first('whatsapp') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">{{trans('admin.address')}}</label>
                                            <input value="{{ $customer->address }}" type="text" class="form-control" name="address" placeholder="address" required>
                                            @if ($errors->has('address'))
                                            <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> {{trans('admin.reset')}}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{trans('admin.save')}}
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>

@stop