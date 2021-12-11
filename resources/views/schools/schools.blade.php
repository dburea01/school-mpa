@extends('layouts.layout_with_menu_sidebar')

@section('content')

<h1 class="text-center">Schools list</h1>

<table class="table table-sm table-striped table-bordered table-hover">
    @foreach ($schools as $school)
    <tr>
        <td>{{ $school->name }}</td>
        <td>{{ $school->zip_code }} - {{ $school->city }}</td>
        <td>{{ $school->max_users }}
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center">
    {{ $schools->links() }}

</div>
@endsection