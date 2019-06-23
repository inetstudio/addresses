@extends('admin::back.layouts.app')

@php
    $title = ($item['id']) ? 'Редактирование точки' : 'Создание точки';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.addresses.points::back.partials.breadcrumbs.form')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <a class="btn btn-sm btn-white" href="{{ route('back.addresses.points.index') }}">
                    <i class="fa fa-arrow-left"></i> Вернуться назад
                </a>
            </div>
        </div>

        {!! Form::info() !!}

        {!! Form::open(['url' => (! $item['id']) ? route('back.addresses.points.store') : route('back.addresses.points.update', [$item['id']]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}

            @if ($item['id'])
                {{ method_field('PUT') }}
            @endif

            {!! Form::hidden('point_id', (! $item['id']) ? '' : $item['id'], ['id' => 'object-id']) !!}

            {!! Form::hidden('point_type', get_class($item), ['id' => 'object-type']) !!}

            <div class="ibox">
                <div class="ibox-title">
                    {!! Form::buttons('', '', ['back' => 'back.addresses.points.index']) !!}
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-group float-e-margins" id="mainAccordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseMain"
                                               aria-expanded="true">Основная информация</a>
                                        </h5>
                                    </div>
                                    <div id="collapseMain" class="collapse show" aria-expanded="true">
                                        <div class="panel-body">
                                            {!! Form::string('point_type', $item['point_type'], [
                                                'label' => [
                                                    'title' => 'Тип',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('user_address', $item['user_address'], [
                                                'label' => [
                                                    'title' => 'Пользовательский адрес',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('pretty_address', $item['pretty_address'], [
                                                'label' => [
                                                    'title' => 'Распознанный адрес',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('region', $item['region'], [
                                                'label' => [
                                                    'title' => 'Регион',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('district', $item['district'], [
                                                'label' => [
                                                    'title' => 'Район',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('city', $item['city'], [
                                                'label' => [
                                                    'title' => 'Город',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('street', $item['street'], [
                                                'label' => [
                                                    'title' => 'Улица',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('house', $item['house'], [
                                                'label' => [
                                                    'title' => 'Дом',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('building', $item['building'], [
                                                'label' => [
                                                    'title' => 'Корпус',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('structure', $item['structure'], [
                                                'label' => [
                                                    'title' => 'Строение',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('flat', $item['flat'], [
                                                'label' => [
                                                    'title' => 'Квартира',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('zip', $item['zip'], [
                                                'label' => [
                                                    'title' => 'Индекс',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('lat', $item['lat'], [
                                                'label' => [
                                                    'title' => 'Широта',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('lon', $item['lon'], [
                                                'label' => [
                                                    'title' => 'Долгота',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            {!! Form::string('quality', $item['quality'], [
                                                'label' => [
                                                    'title' => 'Качество распознавания',
                                                    'class' => 'col-sm-2 control-label',
                                                ],
                                                'field' => [
                                                    'class' => 'form-control',
                                                ],
                                            ]) !!}

                                            <div class="form-group row">
                                                <label for="message" class="col-sm-2 control-label font-bold">Дополнительная
                                                    информация</label>

                                                <div class="col-sm-10">
                                                    <pre class="json-data">@json($item['additional_info'])</pre>
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-footer">
                    {!! Form::buttons('', '', ['back' => 'back.addresses.points.index']) !!}
                </div>
            </div>

        {!! Form::close()!!}
    </div>
@endsection
