<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGroup;
use App\Models\ProductWarehouse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::where('domain', getDomain())
            ->orderBy('position')
            ->with(['products' => function ($q) {
                $q->orderBy('position');
            }])
            ->get();

        return view('adminpanel.products.index', compact('categories'));
    }

    public function product_orders(Request $request, $status = null)
    {
        // Map URL path status to DB status
        $statusMap = [
            'manual'      => 'Manual',
            'awaiting'    => 'Awaiting',
            'failed'      => 'Failed',
            'pending'     => 'Pending',
            'inprogress'  => 'In progress',
            'completed'   => 'Completed',
            'partial'     => 'Partial',
            'canceled'    => 'Canceled',
        ];

        $dbStatus = $status ? ($statusMap[$status] ?? null) : null;

        $query = \App\Models\ProductOrder::with(['user', 'product'])
            ->where('domain', getDomain());

        if ($dbStatus) {
            $query->where('status', $dbStatus);
        }

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('provider_id')) {
            $query->where('provider_product_order_id', $request->provider_id);
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(50);

        $products = Product::where('domain', getDomain())
            ->orderBy('name')
            ->get(['id', 'name']);

        $stats = [
            'total'       => \App\Models\ProductOrder::where('domain', getDomain())->count(),
            'awaiting'    => \App\Models\ProductOrder::where('domain', getDomain())->where('status', 'Awaiting')->count(),
            'in_progress' => \App\Models\ProductOrder::where('domain', getDomain())->where('status', 'In progress')->count(),
            'completed'   => \App\Models\ProductOrder::where('domain', getDomain())->where('status', 'Completed')->count(),
        ];

        return view('adminpanel.product_orders.index', compact('orders', 'products', 'stats', 'status'));
    }

    public function warehouse()
    {
        $warehouses = ProductWarehouse::where('domain', getDomain())
            ->withCount(['goods', 'availableGoods'])
            ->orderBy('position')
            ->get();

        return view('adminpanel.products.warehouse', compact('warehouses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'slug'                => 'nullable|string|max:255',
            'type'                => 'required|in:Manual,Api',
            'status'              => 'required|in:In stock,Out of stock,Inactive',
            'product_category_id' => 'required|exists:product_categories,id',
            'product_group_id'    => 'nullable|exists:product_groups,id',
            'group_tag'           => 'nullable|string|max:100',
            'thumbnail'           => 'nullable|string|max:500',
            'cost_price'          => 'nullable|numeric|min:0',
            'price'               => 'required|numeric|min:0',
            'price_1'             => 'required|numeric|min:0',
            'price_2'             => 'required|numeric|min:0',
            'price_percent'       => 'nullable|numeric',
            'price_1_percent'     => 'nullable|numeric',
            'price_2_percent'     => 'nullable|numeric',
            'min'                 => 'required|integer|min:1',
            'max'                 => 'required|integer|min:1',
            'sync'                => 'nullable|boolean',
            'api_provider_id'     => 'nullable|exists:api_providers,id',
            'api_service_id'      => 'nullable|string|max:100',
            'process_type'        => 'nullable|string|max:50',
        ]);

        $validated['domain']           = getDomain();
        $validated['slug']             = $validated['slug'] ?: \Str::slug($validated['name']);
        $validated['sync']             = $request->boolean('sync');
        $validated['product_group_id'] = ($validated['product_group_id'] ?? 0) > 0 ? $validated['product_group_id'] : null;

        $product = \App\Models\Product::create($validated);

        return response()->json(['success' => true, 'id' => $product->id]);
    }

    public function edit(Request $request)
    {
        $product = \App\Models\Product::where('domain', getDomain())
            ->findOrFail($request->query('id'));

        $categories = ProductCategory::where('domain', getDomain())->where('status', true)->orderBy('position')->get();
        $groups     = ProductGroup::where('domain', getDomain())->orderBy('position')->get();
        $warehouses = ProductWarehouse::where('domain', getDomain())->orderBy('position')->get();
        $providers  = \App\Models\ApiProvider::where('domain', getDomain())->where('status', true)->orderBy('name')->get();
        $languages  = \App\Models\Language::where('domain', getDomain())->where('status', true)->orderBy('code')->get();

        return view('adminpanel.products.update', compact('product', 'categories', 'groups', 'warehouses', 'providers', 'languages'));
    }

    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::where('domain', getDomain())->findOrFail($id);

        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'slug'                => 'nullable|string|max:255',
            'type'                => 'required|in:Manual,Api',
            'status'              => 'required|in:In stock,Out of stock,Inactive',
            'product_category_id' => 'required|exists:product_categories,id',
            'product_group_id'    => 'nullable|integer',
            'group_tag'           => 'nullable|string|max:100',
            'thumbnail'           => 'nullable|string|max:500',
            'description'         => 'nullable|string',
            'warranty_policy'     => 'nullable|string',
            'cost_price'          => 'nullable|numeric|min:0',
            'price'               => 'required|numeric|min:0',
            'price_1'             => 'required|numeric|min:0',
            'price_2'             => 'required|numeric|min:0',
            'price_percent'       => 'nullable|numeric',
            'price_1_percent'     => 'nullable|numeric',
            'price_2_percent'     => 'nullable|numeric',
            'min'                 => 'required|integer|min:1',
            'max'                 => 'required|integer|min:1',
            'sync'                => 'nullable|boolean',
            'api_provider_id'     => 'nullable|exists:api_providers,id',
            'api_service_id'      => 'nullable|string|max:100',
            'process_type'        => 'nullable|string|max:50',
        ]);

        $validated['slug']             = $validated['slug'] ?: \Str::slug($validated['name']);
        $validated['sync']             = $request->boolean('sync');
        $validated['product_group_id'] = ($validated['product_group_id'] ?? 0) > 0 ? $validated['product_group_id'] : null;

        $product->update($validated);

        return response()->json(['success' => true]);
    }

    public function storeGroup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $group = ProductGroup::create([
            'name'     => $validated['name'],
            'domain'   => getDomain(),
            'position' => ProductGroup::where('domain', getDomain())->max('position') + 1,
        ]);

        return response()->json(['success' => true, 'id' => $group->id, 'name' => $group->name]);
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $category = ProductCategory::create([
            'name'     => $validated['name'],
            'status'   => $request->boolean('status', true),
            'domain'   => getDomain(),
            'position' => ProductCategory::where('domain', getDomain())->max('position') + 1,
        ]);

        return response()->json(['success' => true, 'id' => $category->id, 'name' => $category->name]);
    }

    public function reorder(Request $request)
    {
        $type  = $request->input('type', 'product');
        $items = $request->input('items', []);

        foreach ($items as $item) {
            if ($type === 'category') {
                \App\Models\ProductCategory::where('id', $item['id'])
                    ->where('domain', getDomain())
                    ->update(['position' => $item['position']]);
            } else {
                \App\Models\Product::where('id', $item['id'])
                    ->where('domain', getDomain())
                    ->update(['position' => $item['position']]);
            }
        }

        return response()->json(['success' => true]);
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Awaiting,Manual,Pending,In progress,Completed,Partial,Canceled,Failed',
        ]);

        $order = \App\Models\ProductOrder::where('domain', getDomain())->findOrFail($id);
        $newStatus = $request->input('status');

        // Hoàn tiền một phần: validate và trả lại tiền
        if ($newStatus === 'Partial') {
            $remainsInput = $request->input('quantity');
            $remains = ($remainsInput !== null && $remainsInput !== '') ? (int)$remainsInput : null;

            if ($remains === null) {
                return response()->json(['success' => false, 'message' => 'Please input quantity remains'], 422);
            }

            if ($remains < 0 || $remains > (int)$order->quantity) {
                return response()->json(['success' => false, 'message' => 'Invalid quantity remains'], 422);
            }

            // Chỉ hoàn tiền nếu chưa Partial
            if ($order->status !== 'Partial') {
                $refund = (float)$order->charge - (float)$order->amount;
                if ($refund > 0) {
                    $order->user->increment('balance', $refund);
                }
            }
            $order->amount = $remains;
        }

        $order->status = $newStatus;
        $order->save();

        return response()->json(['success' => true]);
    }

    public function updateOrderResult(Request $request, $id)
    {
        $order = \App\Models\ProductOrder::where('domain', getDomain())->findOrFail($id);
        $order->note = $request->input('result', '');
        $order->save();
        return response()->json(['success' => true]);
    }

    public function add()
    {
        $categories = ProductCategory::where('domain', getDomain())
            ->where('status', true)
            ->orderBy('position')
            ->get();

        $groups = ProductGroup::where('domain', getDomain())
            ->orderBy('position')
            ->get();

        $providers = \App\Models\ApiProvider::where('domain', getDomain())
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('adminpanel.products.add', compact('categories', 'groups', 'providers'));
    }
}
