@extends('welcome')

@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($carts as $cart)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{asset($cart->product->image)}}" width="100" height="100" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$cart->product->name}}</a></h4>
							</td>
							<td class="cart_price">
								<p>${{$cart->product->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{route('update.cart', $cart->id)}}" method="POST">
									@csrf
										<input class="cart_quantity_input" type="text" name="qnty" value="{{$cart->qnty}}" autocomplete="off" size="2">
										<button type="submit" class="btn btn-info btn-sm" style="margin: 0 0 0 8px;"><i class="fa fa-check"></i></button>
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{$cart->qnty * $cart->product->price}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{route('destroy.cart', $cart->id)}}"><i class="fa fa-times text-warning"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3 class="text-center">Cart Total Area Section Below Here </h3><br>
			</div>
			<div class="row">
				<div class="col-sm-6">
				@if(Session::has('coupon'))
				@else
					<div class="chose_area">
						<ul class="user_option">
							<li class="text-center">
							<form action="{{route('coupon.apply')}}" method="POST">
							@csrf							
								<label>Use Coupon Code</label>
								<input type="text" name="name" class="form-control" autocomplete="off" placeholder="Coupon name"><br>
								<button type="submit" class="btn btn-warning btn-sm">Apply Coupon</button>
							</form>
							</li>
						</ul>
					</div>
				@endif					
				</div>
				<div class="col-sm-6">
					@if(Session::has('coupon'))
						<div class="total_area">
							<ul>
								<li>Cart Sub Total <span>${{$total}}</span></li>
								<li>Coupon Name <span>{{Session::get('coupon')['name']}}</span></li>
								<li>Coupon Delete
									<span>
										<a href="{{route('coupon.destroy')}}"><i class="fa fa-times text-warning"></i></a>
									</span>
								</li>
								<li>Discount <span>${{$discount = $total * Session::get('coupon')['discount']/100}}</span></li>
								<li>Cart Total <span>${{$total-$discount}}</span></li>
							</ul>
								<a class="btn btn-default check_out" href="">Check Out</a>
						</div>
					@else
						<div class="total_area">
							<ul>
								<li>Cart Sub Total <span>${{$total}}</span></li>
								<li>Total <span>${{$total}}</span></li>
							</ul>
								<a class="btn btn-default check_out" href="">Check Out</a>
						</div>
					@endif
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection