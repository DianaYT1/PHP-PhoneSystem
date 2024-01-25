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
