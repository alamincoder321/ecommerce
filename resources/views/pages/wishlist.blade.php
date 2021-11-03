@extends('welcome')

@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Wishlist</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="total">Total</td>
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($wishlists as $row)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{asset($row->product->image)}}" width="100" height="100" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$row->product->name}}</a></h4>
							</td>
							<td>
								<span>
									<form action="{{route('add.cart', $row->product_id)}}" method="POST">
										@csrf
									<button type="submit" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
									</form>
								</span>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{$row->product->price}}</p>
							</td>

							<td class="cart_delete">
								<a href="{{route('destroy.wishlist', $row->id)}}" class="cart_quantity_delete" href=""><i class="fa fa-times text-warning"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection