@extends('adminpanel.layouts.app')
@section('title', 'Ticket Subjects')
@section('content')
<div class="content flex-row-fluid" id="kt_content">

    <div class="d-flex">
        <button class="btn btn-primary btn-sm" onclick="showModalAdd()">
            <span data-lang="Add new">Thêm mới</span>
        </button>
    </div>

    <div class="p-5 text-muted text-end pointer" onclick="collapseAll()" id="collapse-all-btn">
        <span class="fst-italic" data-lang="Collapse all">Thu gọn tất cả</span>
        <i class="bi bi-arrows-collapse fs-4 ms-2" id="collapse-all-icon"></i>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-7 gy-2 gs-5 mb-0" id="table-subjects">
                    @php $grouped = $subjects->groupBy('category'); @endphp
                    @forelse($grouped as $catName => $items)
                    <tbody class="tbody-cat" data-category="{{ $catName }}">
                        <tr class="bg-secondary tr-category-header" data-category="{{ $catName }}">
                            <td colspan="6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 fs-5 fw-bolder d-flex align-items-center">
                                        <i class="bi bi-tag me-3 text-muted"></i>
                                        <span class="ls-1">{{ $catName }}</span>
                                    </div>
                                    <div class="text-end fs-8 show-hide pointer"
                                        style="border-bottom: 0.5px dashed"
                                        data-status="Hide"
                                        onclick="collapseCategory(this, this.getAttribute('data-status'), '{{ addslashes($catName) }}')">
                                        <span class="show-hide-text" data-lang="Hide">Ẩn</span>
                                        ({{ $items->count() }})
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @foreach($items as $subject)
                        <tr id="row-{{ $subject->id }}"
                            class="tr-subject {{ $subject->status ? '' : 'text-muted' }}"
                            data-category="{{ $catName }}"
                            @if(!$subject->status) style="opacity:0.6" @endif>
                            <td width="1"><i class="fas fa-bars drag-handle"></i></td>
                            <td width="1">
                                <a href="javascript:;" onclick='showModalEdit({{ $subject->id }}, @json($subject))'>
                                    <i class="bi bi-pencil fs-8"></i>
                                </a>
                            </td>
                            {{-- Tên + badges --}}
                            <td>
                                <div class="d-flex align-items-center flex-wrap gap-2">
                                    <span class="fw-semibold text-gray-800">
                                        {{ $subject->subcategory ?: '—' }}
                                    </span>
                                    @if($subject->show_message_only)
                                        <span class="badge badge-light-primary fs-9 py-1 px-2">
                                            <i class="bi bi-chat-text me-1"></i>Message only
                                        </span>
                                    @endif
                                    @if(!empty($subject->required_fields))
                                        @foreach($subject->required_fields as $f)
                                            <span class="badge badge-light-info fs-9 py-1 px-2">
                                                {{ $f['name'] ?? ($f['id'] ?? '') }}
                                                @if(!empty($f['required']))
                                                    <span class="text-danger ms-1">*</span>
                                                @endif
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                            {{-- Sort order --}}
                            <td width="1" class="text-muted fs-8 text-center">
                                <span class="sort-order-display">{{ $subject->sort_order }}</span>
                            </td>
                            {{-- Toggle --}}
                            <td class="text-end" width="1">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input h-20px w-30px" type="checkbox"
                                        value="{{ $subject->id }}"
                                        @if(intval($subject->status) === 1) checked @endif
                                        onchange="toggleStatus(this.value, this.checked)">
                                </div>
                            </td>
                            {{-- Delete --}}
                            <td width="1">
                                <a href="javascript:;" onclick="deleteSubject({{ $subject->id }})"
                                    class="text-danger opacity-50">
                                    <i class="bi bi-trash fs-8"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @empty
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-10" data-lang="No data">Chưa có ticket subject nào</td>
                        </tr>
                    </tbody>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="modal-subject" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="modal-subject-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-subject-label" data-lang="Add new">Thêm mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-5">
                    <label class="required form-label" data-lang="Category">Category</label>
                    <input type="text" id="ipt-category" class="form-control form-control-solid"
                        list="cat-list" placeholder="Category" data-lang="Category">
                    <datalist id="cat-list">
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="mb-5">
                    <label class="form-label" data-lang="Subcategory">Subcategory</label>
                    <input type="text" id="ipt-subcategory" class="form-control form-control-solid"
                        placeholder="Subcategory" data-lang="Subcategory">
                </div>

                <div class="separator separator-dashed my-4"></div>

                <div class="row g-5 mb-5">
                    <div class="col-6">
                        <label class="required form-label" data-lang="Status">Trạng thái</label>
                        <select id="ipt-status" class="form-select form-select-solid">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label" data-lang="Sort Order">Sort Order</label>
                        <input type="number" id="ipt-sort" class="form-control form-control-solid" value="0" min="0">
                    </div>
                </div>

                <div class="form-check form-switch form-check-custom form-check-solid mb-5">
                    <input class="form-check-input h-20px w-30px" type="checkbox" id="ipt-message-only">
                    <label class="form-check-label ms-2" for="ipt-message-only" data-lang="Message Only">Show Message Only</label>
                </div>

                <div class="separator separator-dashed my-4"></div>

                <div class="mb-2">
                    <label class="form-label">
                        <span data-lang="Required Fields">Required Fields</span>
                        <span class="text-muted fs-7">(JSON array)</span>
                        <a href="javascript:;" class="ms-2 fs-8 text-primary" onclick="insertExample()" data-lang="Example">Ví dụ</a>
                    </label>
                    <textarea id="ipt-fields" class="form-control form-control-solid font-monospace" rows="4"
                        placeholder='[{"id":"order_id","name":"Order ID","type":"text","required":true}]'></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal" data-lang="button::Close">Đóng</button>
                <button type="button" class="btn btn-primary btn-sm btn-save-subject">
                    <span class="btn-text" data-lang="Add new">Thêm</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .show-hide { cursor: pointer; }
    .pointer { cursor: pointer; }
    .drag-handle { cursor: grab; color: #b5b5c3; transition: color 0.2s; }
    .drag-handle:hover { color: #3699ff; }
    .drag-handle:active { cursor: grabbing; }
    .sortable-ghost { opacity: 0.3; background: #e1f0ff !important; }
    .sortable-chosen { background: #f3f6f9 !important; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .sortable-drag { background: #fff !important; box-shadow: 0 4px 16px rgba(0,0,0,0.12); transform: rotate(1deg); }
</style>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
var CSRF = '{{ csrf_token() }}';
var editingId = null;
var allCollapsed = false;

// Khởi tạo SortableJS cho từng tbody
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.tbody-cat').forEach(function (tbody) {
        new Sortable(tbody, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            filter: '.tr-category-header', // không kéo header
            onEnd: function (evt) {
                // Chỉ lấy các tr-subject trong tbody này
                var rows = tbody.querySelectorAll('.tr-subject');
                var items = [];
                rows.forEach(function (row, index) {
                    var id = row.id.replace('row-', '');
                    items.push({ id: parseInt(id), sort_order: index + 1 });
                    // Cập nhật số hiển thị
                    var sortCell = row.querySelector('.sort-order-display');
                    if (sortCell) sortCell.textContent = index + 1;
                });

                fetch('/admin/ticket-subjects/reorder', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF
                    },
                    body: JSON.stringify({ items: items })
                })
                .then(r => r.json())
                .then(data => { /* silent */ })
                .catch(() => { /* silent */ });
            }
        });
    });
});

function collapseCategory(el, status, category) {
    var tbody = document.querySelector('.tbody-cat[data-category="' + category + '"]');
    if (!tbody) return;
    var rows = tbody.querySelectorAll('.tr-subject');
    if (status === 'Hide') {
        rows.forEach(r => r.style.display = 'none');
        el.setAttribute('data-status', 'Show');
        el.querySelector('.show-hide-text').textContent = 'Hiện ';
    } else {
        rows.forEach(r => r.style.display = '');
        el.setAttribute('data-status', 'Hide');
        el.querySelector('.show-hide-text').textContent = window.tr('Hide') + ' ';
    }
}

function collapseAll() {
    var btns = document.querySelectorAll('.show-hide');
    allCollapsed = !allCollapsed;
    btns.forEach(function(btn) {
        var cat = btn.closest('tr').getAttribute('data-category');
        if (allCollapsed) {
            if (btn.getAttribute('data-status') === 'Hide') collapseCategory(btn, 'Hide', cat);
        } else {
            if (btn.getAttribute('data-status') === 'Show') collapseCategory(btn, 'Show', cat);
        }
    });
    var icon = document.getElementById('collapse-all-icon');
    icon.className = allCollapsed ? 'bi bi-arrows-expand fs-4 ms-2' : 'bi bi-arrows-collapse fs-4 ms-2';
}

function showModalAdd() {
    editingId = null;
    document.getElementById('modal-subject-label').textContent = 'Thêm mới';
    document.getElementById('ipt-category').value = '';
    document.getElementById('ipt-subcategory').value = '';
    document.getElementById('ipt-status').value = '1';
    document.getElementById('ipt-sort').value = '0';
    document.getElementById('ipt-message-only').checked = false;
    document.getElementById('ipt-fields').value = '';
    document.querySelector('.btn-save-subject .btn-text').textContent = 'Thêm';
    new bootstrap.Modal(document.getElementById('modal-subject')).show();
}

function showModalEdit(id, subject) {
    editingId = id;
    document.getElementById('modal-subject-label').textContent = 'Chỉnh sửa';
    document.getElementById('ipt-category').value = subject.category || '';
    document.getElementById('ipt-subcategory').value = subject.subcategory || '';
    document.getElementById('ipt-status').value = subject.status ? '1' : '0';
    document.getElementById('ipt-sort').value = subject.sort_order || 0;
    document.getElementById('ipt-message-only').checked = !!subject.show_message_only;
    document.getElementById('ipt-fields').value = subject.required_fields
        ? JSON.stringify(subject.required_fields, null, 2) : '';
    document.querySelector('.btn-save-subject .btn-text').textContent = 'Cập nhật';
    new bootstrap.Modal(document.getElementById('modal-subject')).show();
}

function insertExample() {
    document.getElementById('ipt-fields').value = JSON.stringify([
        {"id": "order_id", "name": "Order ID", "type": "text", "required": true, "placeholder": "Enter order ID"}
    ], null, 2);
}

document.addEventListener('DOMContentLoaded', function() {
    var btn = document.querySelector('.btn-save-subject');
    var modal = document.getElementById('modal-subject');

    btn.addEventListener('click', async function() {
        var category = document.getElementById('ipt-category').value.trim();
        if (!category) { showToast(window.tr('Name cannot be blank'), 'error'); return; }

        var fieldsJson = document.getElementById('ipt-fields').value.trim();
        if (fieldsJson) {
            try { if (!Array.isArray(JSON.parse(fieldsJson))) throw 1; }
            catch(e) { showToast(window.tr('Invalid format Quantity Discount data'), 'error'); return; }
        }

        showFullScreenLoader('', '#modal-subject');
        btn.disabled = true;
        var orig = btn.querySelector('.btn-text').textContent;
        btn.querySelector('.btn-text').innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>' + window.tr('Waiting') + '...';

        try {
            var url = editingId ? '/admin/ticket-subjects/' + editingId : '/admin/ticket-subjects';
            var body = new URLSearchParams({
                _token: CSRF,
                category: category,
                subcategory: document.getElementById('ipt-subcategory').value.trim(),
                status: document.getElementById('ipt-status').value,
                sort_order: document.getElementById('ipt-sort').value,
                show_message_only: document.getElementById('ipt-message-only').checked ? '1' : '0',
                required_fields_json: fieldsJson
            });
            if (editingId) body.append('_method', 'PUT');

            var r = await fetch(url, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/x-www-form-urlencoded' },
                body: body.toString()
            });
            var data = await r.json();
            hideFullScreenLoader();

            if (data.success) {
                bootstrap.Modal.getInstance(modal).hide();
                setTimeout(() => location.reload(), 300);
            } else {
                var msg = data.errors ? Object.values(data.errors).flat().join('\n') : (data.message || 'Lỗi');
                showToast(msg, 'error');
            }
        } catch(e) {
            hideFullScreenLoader();
            showToast(window.tr('An error occurred!'), 'error');
        } finally {
            btn.disabled = false;
            btn.querySelector('.btn-text').textContent = orig;
        }
    });

    modal.addEventListener('hidden.bs.modal', function() {
        editingId = null;
        btn.disabled = false;
        btn.querySelector('.btn-text').textContent = 'Thêm';
        document.getElementById('modal-subject-label').textContent = 'Thêm mới';
    });
});

function toggleStatus(id, checked) {
    fetch('/admin/ticket-subjects/' + id + '/toggle-status', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/x-www-form-urlencoded' },
        body: '_token=' + CSRF + '&_method=PATCH'
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            var row = document.getElementById('row-' + id);
            if (row) {
                row.style.opacity = checked ? '' : '0.6';
                if (checked) row.classList.remove('text-muted');
                else row.classList.add('text-muted');
            }
        } else {
            var cb = document.querySelector('input[value="' + id + '"]');
            if (cb) cb.checked = !checked;
        }
    });
}

function deleteSubject(id) {
    showConfirmModal(window.tr('Confirm delete'), function () {
        fetch('/admin/ticket-subjects/' + id, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/x-www-form-urlencoded' },
            body: '_token=' + CSRF + '&_method=DELETE'
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                var row = document.getElementById('row-' + id);
                if (row) row.remove();
                showToast(window.tr('Delete successfully'), 'success');
            } else {
                showToast(data.message || 'Lỗi', 'error');
            }
        });
    });
}

function showConfirmModal(message, onOk) {
    document.getElementById('modal-confirm-body').textContent = message;
    var modal = new bootstrap.Modal(document.getElementById('modal-confirm'));
    modal.show();
    var btnOk = document.getElementById('btn-modal-confirm-ok');
    var newBtn = btnOk.cloneNode(true);
    btnOk.parentNode.replaceChild(newBtn, btnOk);
    newBtn.addEventListener('click', function () {
        modal.hide();
        onOk();
    });
}
</script>

{{-- Confirm Modal --}}
<div class="modal fade" id="modal-confirm" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered rounded-4">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white py-4">
                <h4 class="modal-title text-white ls-1" data-lang="Confirm">Xác nhận</h4>
            </div>
            <div class="modal-body py-10 fs-4" id="modal-confirm-body"></div>
            <div class="modal-footer py-4">
                <button type="button" class="btn btn-sm btn-secondary px-4 rounded-4"
                    id="btn-modal-confirm-cancel" data-bs-dismiss="modal" data-lang="Cancel">Hủy</button>
                <button type="button" class="btn btn-sm btn-warning px-4 rounded-4"
                    id="btn-modal-confirm-ok" data-lang="OK">Đồng ý</button>
            </div>
        </div>
    </div>
</div>
@endsection
