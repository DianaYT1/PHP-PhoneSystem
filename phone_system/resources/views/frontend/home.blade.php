@extends('frontend.master')

@section('phones')
    <h1 align="center">Products</h1>
    <div style="text-align: center; margin-bottom: 20px; border-color: blue;">
    <form action="{{ route('search') }}" method="GET" class="search-form">
    @csrf
    <input type="text" name="query" placeholder="Търсене...">
    </form>
</div>
    <main class="table" id="phonesList">

    <table border="1 px" align="center">
        <tr align="center">
            <td>Name</td>
            <td>Model</td>
            <td>Producer</td>
            <td>Year of release</td>
            <td>Product Image</td>
        </tr>

        @foreach($phones as $product)
        <tr align="center">
            <td width="300">{{$product->name}}</td>
            <td>{{$product->model}}</td>
            <td>{{$product->producer}}</td>
            <td width="300">{{$product->year_of_release}}</td>
            <td>
                <img height="150" width="200" src="{{ $product->image }}">
            </td>
        </tr>
        @endforeach

    </table>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    let searchForm = document.querySelector('.search-form');
    let phonesList = document.getElementById('phonesList');

    searchForm.addEventListener('input', function () {
        let searchTerm = searchForm.querySelector('input[name="query"]').value;

        fetch(/search?query=${searchTerm})
            .then(response => response.text())
            .then(data => {
              phonesList.innerHTML = data;
            });
    });
});
</script>

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