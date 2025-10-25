@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Danh sách Template</h2>
    <div class="row">
        @foreach($templates as $template)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $template->name }}</h5>
                        <p class="card-text">{{ $template->description }}</p>
                        <p class="card-text"><strong>User:</strong> {{ $template->user->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
