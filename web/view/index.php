@extends('layout')

@section('content')
<?php
foreach ($users as $user) {
    echo $user['name'] . '<br>';
}
?>
<h1>Hello World</h1>
@endsection