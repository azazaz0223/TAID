@extends('backend.layout.layout')

@section('container')
@auth('backend')
<h3>hello~
    <?php echo auth('backend')->user()->name ?>
</h3>
@endauth
@endsection
{{-- {{ Request::path() }}; --}}