@extends('frontend.master')
@section('title', 'Chi tiết sản phẩm')
@section('main')
<style>
    .favourite_icon {
        float: right;
        cursor: pointer;
        font-size: 25px !important;
    }
    .favourite_icon:hover {
        opacity: 0.8;
    }
    .favorite-text {
        font-size: 16px;
        color: #222;
    }
</style>
	<link rel="stylesheet" href="css/details.css">
	<div id="wrap-inner">
		<div id="product-info">
			<div class="clearfix"></div>
			<h3>{{ $product->prod_name }}</h3>
			<div class="row">
				<div id="product-img" class="col-xs-12 col-sm-12 col-md-3 text-center">
					<img width="210px" src="{{ asset('lib/storage/app/avatar/'.$product->prod_img) }}">
                    <div style="display: flex; align-items: center ; gap: 8px; justify-content: center; margin-top:7px;">
                        @php
                            $isLiked = DB::table('vp_favourite_products')->where('user_id', Auth::id())->where('favou_product', $product->prod_id)->exists();
                            $count = DB::table('vp_favourite_products')->where('favou_product', $product->prod_id)->count();
                        @endphp
                        @if($count > 0 && $isLiked)
                        <svg width="24" height="20" class="x0F377"><path d="M19.469 1.262c-5.284-1.53-7.47 4.142-7.47 4.142S9.815-.269 4.532 1.262C-1.937 3.138.44 13.832 12 19.333c11.559-5.501 13.938-16.195 7.469-18.07z" stroke="#FF424F" stroke-width="1.5" fill="#FF424F" fill-rule="evenodd" stroke-linejoin="round"></path></svg>
                        @else
                            <a style="line-height: 2px;" href="{{ asset('cart/add_favourite/' . $product->prod_id) }}">
                                <svg width="24" height="20" class="x0F377"><path d="M19.469 1.262c-5.284-1.53-7.47 4.142-7.47 4.142S9.815-.269 4.532 1.262C-1.937 3.138.44 13.832 12 19.333c11.559-5.501 13.938-16.195 7.469-18.07z" stroke="#FF424F" stroke-width="1.5" fill="none" fill-rule="evenodd" stroke-linejoin="round"></path></svg>
                            </a>
                        @endif
                        <span class="favorite-text">Đã thích({{ $count }})</span>
                     </div>
                </div>
				<div id="product-details" class="col-xs-12 col-sm-12 col-md-9">
					<p>Giá: <span class="price">{{ number_format($product->prod_price,0,',','.' )}} VND</span></p>
					<p>Nhiên liệu: {{ $product->prod_fuel }}</p>
					<p>Số chỗ ngồi: {{ $product->prod_seat }}</p>
					<p>Hộp số: {{ $product->prod_gear }}</p>
					<p>Tình trạng: {{ $product->prod_condition }}</p>
					<p class="add-cart text-center"><a href="{{ asset('cart/add/' . $product->prod_id) }}">Thêm vào giỏ hàng</a></p>
				</div>
			</div>
		</div>
		<div id="product-detail">
			<h3>Chi tiết sản phẩm</h3>
			<p class="text-justify">{!! $product->prod_description !!}</p>
		</div>
		<div id="comment">
			<h3>Bình luận</h3>
			<div class="col-md-9 comment">
				<form method="post">
					@csrf
					<div class="form-group">
						<label for="email">Email:</label>
						<input required type="email" class="form-control" id="email" name="email">
					</div>
					<div class="form-group">
						<label for="name">Tên:</label>
						<input required type="text" class="form-control" id="name" name="name">
					</div>
					<div class="form-group">
						<label for="cm">Bình luận:</label>
						<textarea required rows="10" id="cm" class="form-control" name="content"></textarea>
					</div>
					<div class="form-group text-right">
						<button type="submit" class="btn btn-default">Gửi</button>
					</div>
				</form>
			</div>
		</div>
		<div id="comment-list">
			@foreach($comments as $comment)
			<ul>
				<li class="com-title">
					{{ $comment->com_name }}
					<br>
					<span>{{ now()->format('d/m/Y') }}</span>
				</li>
				<li class="com-details">
					{{ $comment->com_content }}
				</li>
			</ul>
			@endforeach
		</div>
	</div>
@stop
