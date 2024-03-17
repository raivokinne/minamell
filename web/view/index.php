@include('components/head')
@foreach(users as user)
<p>{{ user }}</p>
@endforeach
@include('components/footer')
