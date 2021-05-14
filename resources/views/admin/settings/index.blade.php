
@extends('layouts.panel')
@section('Setting')
    active
@endsection
@section( $group->name )
    active
@endsection
@section('title')
{{$group->name}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$group->name}}</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title" style="float: right">تنظیمات  {{$group->name}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('settings.update',$group->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    @foreach($group->settings as $setting)
                                        @if($setting->type == 'string')
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif</label>
                                                <input type="text" name="{{$setting->id}}" class="form-control" id="exampleInputEmail1"  value="{{$setting->value}}">
                                            </div>
                                        @elseif($setting->type == 'email')
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif</label>
                                                    <input type="email" name="{{$setting->id}}" class="form-control" id="exampleInputEmail1" value="{{$setting->value}}">
                                                </div>
                                        @elseif($setting->type == 'number')
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif</label>
                                                    <input type="number" name="{{$setting->id}}" class="form-control" id="exampleInputEmail1" value="{{$setting->value}}">
                                                </div>
                                        @elseif($setting->type == 'textarea')
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif</label>
                                            <textarea name="{{$setting->id}}">{{$setting->value}}</textarea>
                                            <script>
                                                CKEDITOR.replace( '{{$setting->id}}' );
                                            </script>
                                            </div>
                                        @elseif($setting->type == 'file')
                                            <div class="form-group">
                                                <label for="exampleInputFile">{{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="{{$setting->id}}" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @elseif($setting->type == 'btn')
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label for="exampleInputFile"> متن {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                        <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[0]}}">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="exampleInputFile"> لینک {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                        <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[1]}}">
                                                    </div>

                                                </div>
                                            @elseif($setting->type == 'itdb')
                                                <div class="row">
                                                    <div class="form-group col-3">
                                                        <label for="exampleInputFile"> آیکن {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                        <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[0] ?? ''}}">
                                                    </div>
                                                    <div class="form-group col-3">
                                                        <label for="exampleInputFile"> عنوان {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                        <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[1] ?? ''}}">
                                                    </div>

                                                    <div class="form-group col-3">
                                                        <label for="exampleInputFile"> متن دکمه {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                        <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[2] ?? ''}}">
                                                    </div>
                                                    <div class="form-group col-3">
                                                        <label for="exampleInputFile"> لینک دکمه {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                        <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[3] ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="exampleInputFile"> متن {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                        <textarea type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile">{{json_decode($setting->value)[4] ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                        @elseif($setting->type == 'itd')
                                            <div class="row">
                                                <div class="form-group col-3">
                                                    <label for="exampleInputFile"> آیکن {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                    <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[0] ?? ''}}">
                                                </div>
                                                <div class="form-group col-3">
                                                    <label for="exampleInputFile"> عنوان {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                    <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[1] ?? ''}}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="exampleInputFile"> متن {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                    <textarea type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile">{{json_decode($setting->value)[2] ?? ''}}</textarea>
                                                </div>
                                            </div>

                                        @elseif($setting->type == 'counter')
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="exampleInputFile"> آیکن {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                    <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[0] ?? ''}}">
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="exampleInputFile"> عنوان {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                    <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[1] ?? ''}}">
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="exampleInputFile"> تعداد {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                    <input type="number" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[2] ?? ''}}">
                                                </div>
                                            </div>
                                        @elseif($setting->type == 'link')
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="exampleInputFile"> عنوان {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                    <input type="text" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[0] ?? ''}}">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="exampleInputFile"> لینک {{$setting->description}} @if($setting->section_name) {{setting($setting->section_name)}} @endif </label>
                                                    <input type="number" name="{{$setting->id}}[]" class="form-control" id="exampleInputFile" value="{{json_decode($setting->value)[1] ?? ''}}">
                                                </div>
                                            </div>
                                            @endif
                                    @endforeach
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">ویرایش</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
