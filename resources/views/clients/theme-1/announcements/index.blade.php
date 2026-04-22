@extends('layouts.app')

@section('title', 'Announcements')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Announcements</h1>

    @if ($announcements->count())
        <div class="row">
            @foreach ($announcements as $announcement)
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{{ $announcement->title }}</h5>
                                <small class="text-muted">{{ $announcement->created_at->format('M d, Y H:i') }}</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>{{ $announcement->content }}</p>
                            @if ($announcement->link)
                                <a href="{{ $announcement->link }}" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Learn More
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $announcements->links() }}
    @else
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No announcements at the moment.
        </div>
    @endif
</div>
@endsection
