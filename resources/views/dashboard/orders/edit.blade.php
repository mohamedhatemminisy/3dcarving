@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> {{trans('admin.home')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('orders.index')}}"> {{trans('admin.orders')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active"> {{trans('admin.edit')}} - {{$order -> code}}
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
                                <h4 class="card-title" id="basic-layout-form"> {{trans('admin.edit')}} - {{$order ->
                                    code}} </h4>
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
                                    <form method="post" action="{{ route('orders.update', $order->id) }}" enctype="multipart/form-data">
                                        @method('patch')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="code" class="form-label">{{trans('admin.code')}}</label>
                                            <input value="{{ $order->code }}" type="text" class="form-control"
                                                name="code" placeholder="code" required>

                                            @if ($errors->has('code'))
                                            <span class="text-danger text-left">{{ $errors->first('code') }}</span>
                                            @endif
                                        </div>

                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <div class="mb-3">
                                            <label for="customer_id"> @lang('admin.customer')
                                            </label>
                                            <select name="customer_id" class="select2 form-control">
                                                <option disabled selected> @lang('admin.select_customer')</option>
                                                @if($customers && $customers -> count() > 0)
                                                @foreach($customers as $customer)
                                                <option value="{{$customer -> id }}" @if($order->customer_id ==
                                                    $customer->id) selected @endif>{{$customer -> name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('customer_id')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('admin.description')<span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('description') is-invalid @enderror "
                                                type="text" name="description" rows="4"
                                                id="editor1">{{old('description',$order->description )}}</textarea>
                                            @error("description" )
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <script>
                                            CKEDITOR.replace('editor1', {
                                                extraPlugins: 'bidi',
                                                // Setting default language direction to right-to-left.
                                                contentsLangDirection: 'ltr',
                                                height: 270,
                                                scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
                                                scayt_sLang: 'auto',
                                                removeButtons: 'PasteFromWord'
                                            });
                                        </script>


                                        <div class="mb-3">
                                            <label>@lang('admin.files') <span class="text-danger">*</span></label>
                                            <input type="file" name="files[]" placeholder="@lang('admin.files')"
                                                class="form-control" multiple>
                                            @error("files")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                onclick="history.back();">
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