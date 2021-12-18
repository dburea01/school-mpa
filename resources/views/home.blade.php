@extends('layouts.layout_without_menu_sidebar')

@section('content')

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus nemo amet quam, aperiam non praesentium
    reiciendis maxime animi, nisi eum labore? Sapiente suscipit amet, porro iure error sunt sequi tenetur.</p>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias magnam nihil nam non sed corporis, ut doloribus
    delectus ullam laboriosam suscipit corrupti quam provident culpa velit consequatur eum repellat maxime.</p>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores consectetur labore nulla expedita minima nihil,
    saepe, qui quod explicabo mollitia alias excepturi impedit! Quis tempora reiciendis dolorum recusandae magnam
    accusantium?</p>

@auth
<a href="/home_connected">Your Home</a>

@else
<a href="/login">Connection</a>
@endauth


@endsection