@extends('layouts.app')

@section('content')
    <div>
        <ul>
            @foreach ($cars as $car)
                <div>
                    {{ $car->title }}
                </div>
            @endforeach
        </ul>
    </div>
@endsection