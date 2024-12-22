@extends('backend.master')
@section('title', 'Thuế')
@section('main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .revenue {
        font-size: 25px;
        padding: 10px;
    }
</style>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thuế</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-md-5 col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Tổng thuế của cửa hàng
                    </div>
                    <p class="revenue">
                        Tổng thuế: {{ $tax  }}.000.000 đ
                    </p>
                </div>
			</div>
		</div>
	</div>
@stop
