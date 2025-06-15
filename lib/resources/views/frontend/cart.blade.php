@extends('frontend.master')
@section('title', 'Giỏ hàng')
@section('main')
<script type="text/javascript">
	function updateCart(quantity, rowId) {
		$.get(
			'{{ asset('cart/update') }}',
			{ quantity: quantity, rowId: rowId },
			function(){
				location.reload();
			}
		);
	}
</script>
	<link rel="stylesheet" href="css/cart.css">
	<div id="wrap-inner">
		<div id="list-cart">
			<h3>Giỏ hàng</h3>
			@if(Cart::count() >=1)
			<form>
				<table class="table table-bordered .table-responsive text-center">
					<tr class="active">
						<td width="11.111%">Ảnh mô tả</td>
						<td width="22.222%">Tên sản phẩm</td>
						<td width="22.222%">Số lượng</td>
						<td width="16.6665%">Đơn giá</td>
						<td width="16.6665%">Thành tiền</td>
						<td width="11.112%">Xóa</td>
					</tr>
					@foreach($products as $product)
						<tr>
							<td><img width="200px" class="img-responsive" src="{{ asset('lib/storage/app/avatar/'.$product->options->img) }}"></td>
							<td>{{ $product->name }}</td>
							<td>
								<div class="form-group">
									<input class="form-control" min="1" type="number" name="quantity" value="{{ $product->qty }}" onchange="updateCart(this.value, '{{ $product->rowId }}')">
								</div>
							</td>
							<td><span class="price">{{ number_format($product->price,0,',','.' ) }} đ</span></td>
							<td><span class="price">{{ number_format($product->price * $product->qty,0,',','.' ) }} đ</span></td>
							<td><a href="{{ asset('cart/delete/' . $product->rowId) }}">Xóa</a></td>
						</tr>
					@endforeach
				</table>
				<div class="row" id="total-price">
					<div class="col-md-6 col-sm-12 col-xs-12">
							Tổng thanh toán:
                            <span class="total-price">
                                <?php
                                    $so = intval(str_replace(',', '', $total));
                                    $so_moi = number_format($so, 0, '.', ',');
                                ?>
                                    {{  $so_moi }} đ
                            </span>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<a href="{{ asset('/') }}" class="my-btn btn">Mua tiếp</a>
						<a href="{{ asset('cart/delete/all') }}" class="my-btn btn">Xóa giỏ hàng</a>
					</div>
				</div>
			</form>
		</div>

        <div id="xac-nhan">
			<h3>Xác nhận mua hàng</h3>
			<form method="post">
				@csrf
				<div class="form-group">
					<label for="email">Email address:</label>
					<input required type="email" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="name">Họ và tên:</label>
					<input required type="text" class="form-control" id="name" name="name">
				</div>
				<div class="form-group">
					<label for="phone">Số điện thoại:</label>
					<input required type="number" class="form-control" id="phone" name="phone">
				</div>
				<div class="form-group">
					<label for="add">Địa chỉ:</label>
					<input required type="text" class="form-control" id="add" name="add">
				</div>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-default">Đặt hàng</button>
				</div>
			</form>
		</div>

		@else
			<img class="d-flex" style="margin: auto;" width="500" src="img/home/emptycart.jfif">
		@endif
	</div>
@stop
