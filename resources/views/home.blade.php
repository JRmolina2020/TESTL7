@extends('layout')
@section('measure')
<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 principal">
@endsection
@section('titlepanel','Indicadores Ecónomicos de la empresa')
@section('content')
<div class="row">
  <div class="col-lg-3 col-sm-12 col-xs-12 col-md-6">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fi fi-male"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Usuarios registrados</span>
        <span class="info-box-number">0</span>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-12 col-xs-12 col-md-6">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fi fi-persons"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Clientes</span>
        <span class="info-box-number"> 0</span>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-12 col-xs-12 col-md-6">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-primary elevation-1"><i class="fi fi-line-chart"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total gastos hoy</span>
        <span class="info-box-number"> 0</span>
      </div>
    </div>
  </div>
</div>
</div>
@endsection