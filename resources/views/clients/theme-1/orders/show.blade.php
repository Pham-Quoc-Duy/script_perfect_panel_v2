@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Order #{{ $order->id }}</h1>
                <a href="{{ route('client.orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Details</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Service:</strong> 
                                @php
                                    $serviceName = $order->service->name ?? 'N/A';
                                    if (is_array($serviceName)) {
                                        $serviceName = reset($serviceName) ?? 'N/A';
                                    }
                                    $serviceName = (string) $serviceName;
                                @endphp
                                {{ $serviceName }}
                            </p>
                            <p><strong>Link:</strong> <a href="{{ $order->link }}" target="_blank">{{ $order->link }}</a></p>
                            <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> 
                                <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            <p><strong>Price:</strong> ${{ $order->price }}</p>
                            <p><strong>Created:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    @if ($order->comments)
                        <div class="mb-3">
                            <strong>Comments:</strong>
                            <p>{{ $order->comments }}</p>
                        </div>
                    @endif

                    @if ($order->status === 'pending')
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Your order is being processed. Please wait.
                        </div>
                    @elseif ($order->status === 'completed')
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> Your order has been completed successfully!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
