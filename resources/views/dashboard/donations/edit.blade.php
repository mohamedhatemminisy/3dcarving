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
                            <li class="breadcrumb-item"><a href="{{route('donations.index')}}"> {{trans('admin.donations')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active"> {{trans('admin.edit')}} - {{$donation -> name}}
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
                                <h4 class="card-title" id="basic-layout-form"> {{trans('admin.edit')}} - {{$donation -> name}} </h4>
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
                                    <form method="post" action="{{ route('donations.update', $donation->id) }}">
                                        @method('patch')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{trans('admin.name')}}</label>
                                            <input value="{{ $donation->name }}" type="text" class="form-control" name="name" placeholder="name">

                                            @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="collection_date" class="form-label">{{trans('admin.collection_date')}}</label>
                                            <input value="{{ $donation->collection_date }}" type="date" class="form-control" name="collection_date" placeholder="collection_date">
                                            @if ($errors->has('collection_date'))
                                            <span class="text-danger text-left">{{ $errors->first('collection_date') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">{{trans('admin.start_date')}}</label>
                                            <input value="{{ $donation->start_date }}" type="date" class="form-control" name="start_date" placeholder="start_date">
                                            @if ($errors->has('start_date'))
                                            <span class="text-danger text-left">{{ $errors->first('start_date') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">{{trans('admin.end_date')}}</label>
                                            <input value="{{ $donation->end_date }}" type="date" class="form-control" name="end_date" placeholder="end_date">
                                            @if ($errors->has('end_date'))
                                            <span class="text-danger text-left">{{ $errors->first('end_date') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="donator_id"> @lang('admin.donatiors')
                                            </label>
                                            <select name="donator_id" class="select2 form-control">
                                                <option disabled selected> @lang('admin.select_customer')</option>
                                                @if($donatiors && $donatiors -> count() > 0)
                                                @foreach($donatiors as $donatior)
                                                <option value="{{$donatior -> id }}" @if($donation->donator_id ==
                                                    $donatior->id) selected @endif>{{$donatior -> name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('donator_id')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="party_id"> @lang('admin.parties')
                                            </label>
                                            <select name="party_id" class="select2 form-control">
                                                <option disabled selected> @lang('admin.select_customer')</option>
                                                @if($parties && $parties -> count() > 0)
                                                @foreach($parties as $party)
                                                <option value="{{$party -> id }}" @if($donation->party_id ==
                                                    $party->id) selected @endif>{{$party -> name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('party_id')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">{{trans('admin.price')}}</label>
                                            <input value="{{ $donation->price }}" type="text" class="form-control" name="price" placeholder="price">

                                            @if ($errors->has('price'))
                                            <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">{{trans('admin.address')}}</label>
                                            <input value="{{ $donation->address }}" type="text" class="form-control" name="address" placeholder="address">

                                            @if ($errors->has('address'))
                                            <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('admin.files') <span class="text-danger">*</span></label>
                                            <input type="file" name="files[]" placeholder="@lang('admin.files')"
                                                class="form-control" multiple>
                                            @error("files")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
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