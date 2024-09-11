@extends('layouts.master')
@section('css')
@livewireStyles
@section('title')
Files
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> Files </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item ">    Main Proccess   </li>
                <li class="breadcrumb-item ">    Sub Proccess   </li>
                <li class="breadcrumb-item active">    Files   </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->


    @livewire('files', ['id' => $id])
<!-- row closed -->
@endsection
@section('js')
@livewireScripts
@endsection

