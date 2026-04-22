@extends('clients.theme-default.layouts.app')

@section('title', __('api.title'))

@section('content')
    <!-- Main variables *content* -->
    <div id="block_api">
        <div class="block-bg"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="mb-4">{{ __('api.title') }}</h2>
                            
                            <!-- API Configuration -->
                            <div class="mb-5">
                                <div class="table-bg">
                                    <div class="table-wr">
                                        <table class="table mb-3">
                                            <tbody>
                                                <tr>
                                                    <td class="width-40">{{ __('api.http_method') }}</td>
                                                    <td>POST</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('api.api_url') }}</td>
                                                    <td>https://{{ getDomain() }}/api/v2</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('api.api_key') }}</td>
                                                    <td>{{ __('api.generate_key') }} on the <a href="{{ route('clients.account.index') }}">{{ __('api.account_page') }}</a> page</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('api.response_format') }}</td>
                                                    <td>JSON</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Service List -->
                            <div class="mb-5">
                                <h4 class="mb-3">{{ __('api.service_list') }}</h4>
                                <div class="table-bg">
                                    <div class="table-wr">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">{{ __('api.parameters') }}</th>
                                                    <th>{{ __('api.description') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>{{ __('api.api_key') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>services</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6>{{ __('api.example_response') }}</h6>
                                </div>
                                <pre>[
    {
        "service": 1,
        "name": "Followers",
        "type": "Default",
        "category": "First Category",
        "rate": "0.90",
        "min": "50",
        "max": "10000",
        "refill": true,
        "cancel": true
    },
    {
        "service": 2,
        "name": "Comments",
        "type": "Custom Comments",
        "category": "Second Category",
        "rate": "8",
        "min": "10",
        "max": "1500",
        "refill": false,
        "cancel": true
    }
]
</pre>
                            </div>

                            <!-- Add Order -->
                            <div class="mb-5">
                                <h4 class="mb-3">{{ __('api.add_order') }}</h4>
                                <form class="mb-3">
                                    <div class="form-group">
                                        <select class="form-control input-sm" id="type_service">
                                            <option value="Default">Default</option>
                                            <option value="Package">Package</option>
                                            <option value="Custom Comments">Custom Comments</option>
                                            <option value="Subscriptions">Subscriptions</option>
                                        </select>
                                    </div>
                                </form>
                                <!-- Default Service Type -->
                                <div id="type_0" style="">
                                    <div class="table-bg">
                                        <div class="table-wr">
                                            <table class="table mb-3">
                                                <thead>
                                                    <tr>
                                                        <th class="width-40">{{ __('api.parameters') }}</th>
                                                        <th>{{ __('api.description') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>key</td>
                                                        <td>Your API key</td>
                                                    </tr>
                                                    <tr>
                                                        <td>action</td>
                                                        <td>add</td>
                                                    </tr>
                                                    <tr>
                                                        <td>service</td>
                                                        <td>Service ID</td>
                                                    </tr>
                                                    <tr>
                                                        <td>link</td>
                                                        <td>Link to page</td>
                                                    </tr>
                                                    <tr>
                                                        <td>quantity</td>
                                                        <td>Needed quantity</td>
                                                    </tr>
                                                    <tr>
                                                        <td>runs (optional)</td>
                                                        <td>Runs to deliver</td>
                                                    </tr>
                                                    <tr>
                                                        <td>interval (optional)</td>
                                                        <td>Interval in minutes</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Package Service Type -->
                                <div id="type_10" style="display:none;">
                                    <div class="table-bg">
                                        <div class="table-wr">
                                            <table class="table mb-3">
                                                <thead>
                                                    <tr>
                                                        <th class="width-40">{{ __('api.parameters') }}</th>
                                                        <th>{{ __('api.description') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>key</td>
                                                        <td>Your API key</td>
                                                    </tr>
                                                    <tr>
                                                        <td>action</td>
                                                        <td>add</td>
                                                    </tr>
                                                    <tr>
                                                        <td>service</td>
                                                        <td>Service ID</td>
                                                    </tr>
                                                    <tr>
                                                        <td>link</td>
                                                        <td>Link to page</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Custom Comments Service Type -->
                                <div id="type_2" style="display:none;">
                                    <div class="table-bg">
                                        <div class="table-wr">
                                            <table class="table mb-3">
                                                <thead>
                                                    <tr>
                                                        <th class="width-40">{{ __('api.parameters') }}</th>
                                                        <th>{{ __('api.description') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>key</td>
                                                        <td>Your API key</td>
                                                    </tr>
                                                    <tr>
                                                        <td>action</td>
                                                        <td>add</td>
                                                    </tr>
                                                    <tr>
                                                        <td>service</td>
                                                        <td>Service ID</td>
                                                    </tr>
                                                    <tr>
                                                        <td>link</td>
                                                        <td>Link to page</td>
                                                    </tr>
                                                    <tr>
                                                        <td>comments</td>
                                                        <td>Comments list separated by \r\n or \n</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Subscriptions Service Type -->
                                <div id="type_100" style="display:none;">
                                    <div class="table-bg">
                                        <div class="table-wr">
                                            <table class="table mb-3">
                                                <thead>
                                                    <tr>
                                                        <th class="width-40">{{ __('api.parameters') }}</th>
                                                        <th>{{ __('api.description') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>key</td>
                                                        <td>Your API key</td>
                                                    </tr>
                                                    <tr>
                                                        <td>action</td>
                                                        <td>add</td>
                                                    </tr>
                                                    <tr>
                                                        <td>service</td>
                                                        <td>Service ID</td>
                                                    </tr>
                                                    <tr>
                                                        <td>username</td>
                                                        <td>Username</td>
                                                    </tr>
                                                    <tr>
                                                        <td>min</td>
                                                        <td>Quantity min</td>
                                                    </tr>
                                                    <tr>
                                                        <td>max</td>
                                                        <td>Quantity max</td>
                                                    </tr>
                                                    <tr>
                                                        <td>posts (optional)</td>
                                                        <td>Use this parameter if you want to limit the number of new (future) posts that will be parsed and for which orders will be created. If posts parameter is not set, the subscription will be created for an unlimited number of posts.</td>
                                                    </tr>
                                                    <tr>
                                                        <td>old_posts (optional)</td>
                                                        <td>Number of existing posts that will be parsed and for which orders will be created, can be used if this option is available for the service.</td>
                                                    </tr>
                                                    <tr>
                                                        <td>delay</td>
                                                        <td>Delay in minutes. Possible values: 0, 5, 10, 15, 20, 30, 40, 50, 60, 90, 120, 150, 180, 210, 240, 270, 300, 360, 420, 480, 540, 600</td>
                                                    </tr>
                                                    <tr>
                                                        <td>expiry (optional)</td>
                                                        <td>Expiry date. Format d/m/Y</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <h6>Example response</h6>
                                </div>
                                <pre>{
    "order": 23501
}
</pre>
                            </div>

                            <!-- Order Status -->
                            <div class="mb-5">
                                <h4 class="mb-3">{{ __('api.order_status') }}</h4>
                                <div class="table-bg">
                                    <div class="table-wr">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">{{ __('api.parameters') }}</th>
                                                    <th>{{ __('api.description') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>status</td>
                                                </tr>
                                                <tr>
                                                    <td>order</td>
                                                    <td>Order ID</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6>Example response</h6>
                                </div>
                                <pre>{
    "charge": "0.27819",
    "start_count": "3572",
    "status": "Partial",
    "remains": "157",
    "currency": "USD"
}
</pre>
                            </div>

                            <!-- Multiple Orders Status -->
                            <div class="mb-5">
                                <h4 class="mb-3">{{ __('api.multiple_orders_status') }}</h4>
                                <div class="table-bg">
                                    <div class="table-wr">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">{{ __('api.parameters') }}</th>
                                                    <th>{{ __('api.description') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>status</td>
                                                </tr>
                                                <tr>
                                                    <td>orders</td>
                                                    <td>Order IDs (separated by a comma, up to 100 IDs)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6>Example response</h6>
                                </div>
                                <pre>{
    "1": {
        "charge": "0.27819",
        "start_count": "3572",
        "status": "Partial",
        "remains": "157",
        "currency": "USD"
    },
    "10": {
        "error": "Incorrect order ID"
    },
    "100": {
        "charge": "1.44219",
        "start_count": "234",
        "status": "In progress",
        "remains": "10",
        "currency": "USD"
    }
}
</pre>
                            </div>

                            <!-- Create Refill -->
                            <div class="mb-5">
                                <h4 class="mb-3">{{ __('api.create_refill') }}</h4>
                                <div class="table-bg">
                                    <div class="table-wr">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">{{ __('api.parameters') }}</th>
                                                    <th>{{ __('api.description') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>refill</td>
                                                </tr>
                                                <tr>
                                                    <td>order</td>
                                                    <td>Order ID</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6>Example response</h6>
                                </div>
                                <pre>{
    "refill": "1"
}
</pre>
                            </div>

                            <!-- Create Multiple Refill -->
                            <div class="mb-5">
                                <h4 class="mb-3">{{ __('api.create_multiple_refill') }}</h4>
                                <div class="table-bg">
                                    <div class="table-wr">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">{{ __('api.parameters') }}</th>
                                                    <th>{{ __('api.description') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>refill</td>
                                                </tr>
                                                <tr>
                                                    <td>orders</td>
                                                    <td>Order IDs (separated by a comma, up to 100 IDs)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6>Example response</h6>
                                </div>
                                <pre>[
    {
        "order": 1,
        "refill": 1
    },
    {
        "order": 2,
        "refill": 2
    },
    {
        "order": 3,
        "refill": {
            "error": "Incorrect order ID"
        }
    }
]
</pre>
                            </div>

                            <!-- Get Refill Status -->
                            <div class="mb-5">
                                <h4 class="mb-3">{{ __('api.get_refill_status') }}</h4>
                                <div class="table-bg">
                                    <div class="table-wr">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">{{ __('api.parameters') }}</th>
                                                    <th>{{ __('api.description') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>refill_status</td>
                                                </tr>
                                                <tr>
                                                    <td>refill</td>
                                                            <td>refill</td>
                                                    <td>Refill ID</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6>Example response</h6>
                                </div>
                                <pre>{
    "status": "Completed"
}
</pre>
                            </div>

                            <!-- Get Multiple Refill Status -->
                            <div class="mb-5">
                                <h4 class="mb-3">{{ __('api.get_multiple_refill_status') ?? 'Get multiple refill status' }}</h4>
                                <div class="table-bg">
                                    <div class="table-wr">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">{{ __('api.parameters') }}</th>
                                                    <th>{{ __('api.description') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>refill_status</td>
                                                </tr>
                                                <tr>
                                                    <td>refills</td>
                                                    <td>Refill IDs (separated by a comma, up to 100 IDs)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6>Example response</h6>
                                </div>
                                <pre>[
    {
        "refill": 1,
        "status": "Completed"
    },
    {
        "refill": 2,
        "status": "Rejected"
    },
    {
        "refill": 3,
        "status": {
            "error": "Refill not found"
        }
    }
]
</pre>
                            </div>

                            <!-- Create Cancel -->
                            <div class="mb-5">
                                <h4 class="mb-3">{{ __('api.create_cancel') ?? 'Create cancel' }}</h4>
                                <div class="table-bg">
                                    <div class="table-wr">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">{{ __('api.parameters') }}</th>
                                                    <th>{{ __('api.description') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>cancel</td>
                                                </tr>
                                                <tr>
                                                    <td>orders</td>
                                                    <td>Order IDs (separated by a comma, up to 100 IDs)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6>Example response</h6>
                                </div>
                                <pre>[
    {
        "order": 9,
        "cancel": {
            "error": "Incorrect order ID"
        }
    },
    {
        "order": 2,
        "cancel": 1
    }
]
</pre>
                            </div>

                            <!-- User Balance -->
                            <div class="mb-5">
                                <h4 class="mb-3">{{ __('api.user_balance') ?? 'User balance' }}</h4>
                                <div class="table-bg">
                                    <div class="table-wr">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th class="width-40">{{ __('api.parameters') }}</th>
                                                    <th>{{ __('api.description') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>key</td>
                                                    <td>Your API key</td>
                                                </tr>
                                                <tr>
                                                    <td>action</td>
                                                    <td>balance</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h6>Example response</h6>
                                </div>
                                <pre>{
    "balance": "100.84292",
    "currency": "USD"
}
</pre>
                                <div class="mt-4">
                                    <a href="/example.txt" class="btn btn-big-secondary" target="_blank">{{ __('api.example_code') ?? 'Example of PHP code' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeServiceSelect = document.getElementById('type_service');
        
        // Mapping service types to their corresponding div IDs
        const serviceTypeMap = {
            'Default': 'type_0',
            'Package': 'type_10',
            'Custom Comments': 'type_2',
            'Subscriptions': 'type_100'
        };

        // Function to show/hide service type sections
        function updateServiceTypeDisplay(selectedType) {
            // Hide all service type sections
            Object.values(serviceTypeMap).forEach(divId => {
                const element = document.getElementById(divId);
                if (element) {
                    element.style.display = 'none';
                }
            });

            // Show the selected service type section
            const targetDivId = serviceTypeMap[selectedType];
            if (targetDivId) {
                const targetElement = document.getElementById(targetDivId);
                if (targetElement) {
                    targetElement.style.display = 'block';
                }
            }
        }

        // Add event listener to the select element
        if (typeServiceSelect) {
            typeServiceSelect.addEventListener('change', function() {
                updateServiceTypeDisplay(this.value);
            });

            // Initialize with the default selected value
            updateServiceTypeDisplay(typeServiceSelect.value);
        }
    });
</script>
@endpush
