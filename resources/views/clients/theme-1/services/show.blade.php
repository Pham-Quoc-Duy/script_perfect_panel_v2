@extends('layouts.app')

@section('title', is_array($service->name) ? reset($service->name) : $service->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <a href="{{ route('client.services.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Back to Services
            </a>

            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">
                        @php
                            $serviceName = $service->name;
                            if (is_array($serviceName)) {
                                $serviceName = reset($serviceName) ?? 'Service';
                            }
                            $serviceName = (string) $serviceName;
                        @endphp
                        {{ $serviceName }}
                    </h3>
                </div>
                <div class="card-body">
                    <p class="lead">{{ $service->description }}</p>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Price:</strong> <span class="h5 text-primary">${{ $service->price }}/1K</span></p>
                            <p><strong>Minimum Quantity:</strong> {{ $service->min_quantity }}</p>
                            <p><strong>Maximum Quantity:</strong> {{ $service->max_quantity }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Category:</strong> {{ $service->category }}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge bg-{{ $service->is_active ? 'success' : 'danger' }}">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    @if ($service->is_active)
                        <a href="{{ route('client.orders.create', ['service_id' => $service->id]) }}" 
                           class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-cart"></i> Order Now
                        </a>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> This service is currently unavailable.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
