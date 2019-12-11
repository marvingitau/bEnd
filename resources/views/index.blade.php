@include('layouts.app')

@section('cont')
    @foreach ($products as $product)

    {{ $product }}
        
    @endforeach
@endsection