@extends('admin::back.layouts.app')

@php
    $title = 'Точки';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.addresses.points::back.partials.breadcrumbs.index')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="{{ route('back.addresses.points.export') }}" class="btn btn-sm btn-success btn-lg">Экспорт</a>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            {{ $table->table(['class' => 'table table-striped table-bordered table-hover dataTable']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushonce('scripts:datatables_checks_points_index')
{!! $table->scripts() !!}
@endpushonce
