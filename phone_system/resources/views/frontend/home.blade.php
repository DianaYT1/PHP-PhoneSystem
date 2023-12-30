@extends('frontend.master')

@section('content')
<h1 align="center">Products</h1>
<table border="1 px" align="center">

  <tr align="center">
    <td>Name</td>
    <td>Model</td>
    <td>Producer</td>
    <td>Year of release</td>
    <td>Product Image</td>
  </tr>

  @foreach($data as $product)
  <tr align="center">
    <td width="300">{{$product->name}}</td>
    <td>{{$product->model}}</td>
    <td>{{$product->producer}}</td>
    <td width="300">{{$product->year_of_release}}</td>
    <td>

    <img height="150" width="200" src="{{ asset('storage/products/' . $product->image) }}">
    
    </td>
  </tr>
  @endforeach

</table>
@endsection
@section('footer')

<footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2022 Mexant Co., Ltd. All Rights Reserved. 
          
          <br>Designed by <a title="CSS Templates" rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
        </div>
      </div>
    </div>
  </footer>

@endsection