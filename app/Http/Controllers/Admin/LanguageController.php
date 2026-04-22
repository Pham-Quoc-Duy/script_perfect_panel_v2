<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(Request $request)
    {
        $query = Language::where('domain', $request->getHost());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status === '1');
        }

        $languages = $query->orderBy('created_at', 'desc')->get();

        return $request->expectsJson() 
            ? response()->json(['success' => true, 'data' => $languages])
            : view('admin.language.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.language.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:languages',
            'code' => 'required|string|max:10|unique:languages',
            'flag' => 'nullable|url',
            'status' => 'sometimes|boolean'
        ]);

        $validated['status'] = $request->boolean('status');
        $validated['domain'] = $request->getHost();
        $language = Language::create($validated);

        return $request->expectsJson() 
            ? response()->json(['success' => true, 'message' => "Ngôn ngữ <strong>{$language->name}</strong> đã được tạo thành công!", 'language' => $language])
            : redirect()->route('admin.language.index')->with('success', "Ngôn ngữ <strong>{$language->name}</strong> đã được tạo thành công!");
    }

    public function show(Request $request, $id)
    {
        $language = Language::where('domain', $request->getHost())->findOrFail($id);

        return ($request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') 
            ? response()->json(['success' => true, 'language' => $language])
            : view('admin.language.show', compact('language'));
    }

    public function edit(Request $request, $id)
    {
        $language = Language::where('domain', $request->getHost())->findOrFail($id);
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::where('domain', $request->getHost())->findOrFail($id);
        if ($request->has('toggle_status')) {
            $statusValue = $request->input('status');
            $status = is_string($statusValue) ? filter_var($statusValue, FILTER_VALIDATE_BOOLEAN) : (bool) $statusValue;
            
            if ($language->status !== $status) {
                $language->update(['status' => $status]);
                $message = $status ? 'Kích hoạt ngôn ngữ thành công!' : 'Vô hiệu hóa ngôn ngữ thành công!';
            } else {
                $message = 'Trạng thái không thay đổi!';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $status,
                'language' => $language->fresh()
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:languages,name,' . $language->id,
            'code' => 'required|string|max:10|unique:languages,code,' . $language->id,
            'flag' => 'nullable|url'
        ]);

        $validated['status'] = $request->boolean('status');

        $language->update($validated);
        $message = "Ngôn ngữ <strong>{$language->name}</strong> đã được cập nhật thành công!";

        return $request->expectsJson() 
            ? response()->json(['success' => true, 'message' => $message, 'language' => $language->fresh()])
            : redirect()->route('admin.language.index')->with('success', $message);
    }

    public function destroy(Request $request, $id)
    {
        $language = Language::where('domain', $request->getHost())->findOrFail($id);
        $languageName = $language->name;
        $language->delete();

        return $request->expectsJson() 
            ? response()->json(['success' => true, 'message' => "Đã xóa ngôn ngữ {$languageName} thành công!"])
            : redirect()->route('admin.language.index')->with('success', "Đã xóa ngôn ngữ {$languageName} thành công!");
    }

    public function toggleStatus(Request $request, $id)
    {
        $language = Language::where('domain', $request->getHost())->findOrFail($id);
        
        $newStatus = !$language->status;
        $language->update(['status' => $newStatus]);
        
        $message = $newStatus ? 'Kích hoạt ngôn ngữ thành công!' : 'Vô hiệu hóa ngôn ngữ thành công!';
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $newStatus ? 1 : 0,
            'language' => $language->fresh()
        ]);
    }
}
