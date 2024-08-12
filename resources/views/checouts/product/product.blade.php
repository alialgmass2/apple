@extends('checouts.app-organization')
@section('content')
    @foreach($products as $product)
    <div class="card">

        <div class="imgBox">
            <img src="https://www.corsair.com/corsairmedia/sys_master/productcontent/CH-9300011-NA-M65_PRO_RGB_BLK_04.png" alt="mouse corsair" class="mouse">
        </div>

        <div class="contentBox">
            <h3>Mouse Corsair M65</h3>
            <h2 class="price">61.<small>98</small> €</h2>
            <form action="{{route('carts.store')}}" method="post" >
                @csrf

                <input type="hidden" name="product" value="{{$product->id}}">
                <input class="buy" type="submit" value="add to cart">
            </form>
        </div>

    </div>
    @endforeach
@stop
