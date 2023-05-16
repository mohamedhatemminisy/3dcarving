@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> {{trans('admin.mach_types')}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> {{trans('admin.home')}} </a>
                            </li>
                            <li class="breadcrumb-item"> {{trans('admin.mach_types')}}
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
                                <h4 class="card-title"> {{trans('admin.mach_types')}} </h4>
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
                                                <th> {{trans('admin.name')}} </th>
                                                <th> {{trans('admin.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($mach_types as $value)
                                            <tr>
                                                <td>{{ $value->name }}</td>
                                                <td>
                                                    @include('dashboard.components.table-control', ['permission' => 'mach_types',
                                                    'name'=>'mach_types', 'value'=>$value])
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">
                                        {{ $mach_types->links('vendor.pagination.custom') }}
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