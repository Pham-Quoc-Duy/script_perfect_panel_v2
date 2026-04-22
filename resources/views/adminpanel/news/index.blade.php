@extends('adminpanel.layouts.app')
@section('title', 'News')
@section('content')
<div class="content flex-row-fluid" id="kt_content">

    <div class="div-form mb-5" style="display: none;">
        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2 div-title"></h3>
        </div>
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <label class="required form-label" data-lang="Category">Danh mục</label>
                            <select class="form-select form-select-solid sl-category" data-kt-select2="true" data-hide-search="true">
                                <option value="Notification" data-lang="Notification">Thông báo</option>
                                <option value="New service" data-lang="New service">Dịch vụ mới</option>
                                <option value="Change service" data-lang="Change service">Thay đổi dịch vụ</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="required form-label" data-lang="Title">Tiêu đề</label>
                            <input type="text" class="form-control form-control-solid ipt-title">
                        </div>
                        <div>
                            <label class="form-label" data-lang="Content">Nội dung</label>
                            <div id="editor-news-content" style="height: 200px;"></div>
                            <input type="hidden" class="ipt-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-new w-100" onclick="_news.on.click.submit(0)" data-lang="button::Add">Thêm</button>
        <button type="button" class="btn btn-primary btn-update w-100 mt-2" style="display: none;" onclick="_news.on.click.submit(1)" data-lang="button::Update">Cập nhật</button>
    </div>

    <div class="d-flex flex-wrap flex-stack mb-6">
        <h3 class="fw-bold my-2" data-lang="menu::News">Danh sách</h3>
        <div class="d-flex flex-wrap my-2">
            <button class="btn btn-primary btn-sm" onclick="_news.on.click.showFormAdd()" data-lang="button::Add">Thêm thông báo</button>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table align-middle table-row-dashed fs-7 gy-0 mb-0">
                <tbody>
                    @forelse($news as $item)
                    <tr id="news-row-{{ $item->id }}">
                        <td class="px-5 py-3">
                            @php
                                $badgeClass = match($item->category) {
                                    'Notification'   => 'badge-danger',
                                    'New service'    => 'badge-success',
                                    'Change service' => 'badge-warning',
                                    default          => 'badge-secondary',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} me-2 fs-8">
                                <span data-lang="{{ $item->category }}">{{ $item->category }}</span>
                            </span>
                            {{ $item->title }}
                        </td>
                        <td class="text-nowrap" style="width: 120px; vertical-align: middle; line-height: 1.3;">
                            <div>{{ $item->created_at->format('Y-m-d') }}</div>
                            <div>{{ $item->created_at->format('H:i:s') }}</div>
                        </td>
                        <td class="text-nowrap px-3 py-3" style="width: 60px; vertical-align: middle;">
                            <a href="javascript:;" class="btn btn-icon btn-light-secondary btn-circle btn-sm w-25px h-25px" onclick="_news.on.click.showFormEdit({{ $item->id }})" data-lang="button::Edit">
                                <i class="bi bi-pencil fs-8"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon btn-light-danger btn-circle btn-sm w-25px h-25px ms-1" onclick="_news.on.click.delete({{ $item->id }})" data-lang="button::Delete">
                                <i class="bi bi-trash3 fs-8"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-10">Chưa có thông báo nào</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if($news->hasPages())
            <div class="p-4">{{ $news->links() }}</div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="modal-confirm" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning py-4">
                <h4 class="modal-title text-white">Xác nhận</h4>
            </div>
            <div class="modal-body py-10 fs-4" id="modal-confirm-body"></div>
            <div class="modal-footer py-4">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-sm btn-warning px-4" id="btn-modal-confirm-ok">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<script>
var CSRF = '{{ csrf_token() }}';
var _editingId = null;
var _quill = null;

document.addEventListener('DOMContentLoaded', function() {
    if (typeof Quill !== 'undefined') {
        _quill = new Quill('#editor-news-content', {
            theme: 'snow',
            modules: { toolbar: [['bold','italic','underline'],['blockquote'],['link'],['clean']] }
        });
    }
    if (window.$ && $.fn.select2) {
        $('.sl-category').select2({ minimumResultsForSearch: Infinity, width: '100%' });
    }
});

var _news = {
    on: {
        click: {
            showFormAdd: function() {
                _editingId = null;
                document.querySelector('.div-title').textContent = 'Thêm thông báo';
                document.querySelector('.sl-category').value = 'Notification';
                if (window.$ && $('.sl-category').data('select2')) $('.sl-category').trigger('change');
                document.querySelector('.ipt-title').value = '';
                if (_quill) _quill.setText('');
                document.querySelector('.btn-new').style.display = '';
                document.querySelector('.btn-update').style.display = 'none';
                document.querySelector('.div-form').style.display = '';
                document.querySelector('.div-form').scrollIntoView({ behavior: 'smooth' });
            },
            showFormEdit: function(id) {
                if (typeof showFullScreenLoader === 'function') showFullScreenLoader('', '');
                fetch('/admin/news/' + id, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.json())
                .then(data => {
                    if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                    if (!data.success) return;
                    var item = data.item;
                    _editingId = id;
                    document.querySelector('.div-title').textContent = 'Chỉnh sửa thông báo';
                    document.querySelector('.sl-category').value = item.category;
                    if (window.$ && $('.sl-category').data('select2')) $('.sl-category').trigger('change');
                    document.querySelector('.ipt-title').value = item.title;
                    if (_quill) _quill.setText(item.content || '');
                    document.querySelector('.btn-new').style.display = 'none';
                    document.querySelector('.btn-update').style.display = '';
                    document.querySelector('.div-form').style.display = '';
                    document.querySelector('.div-form').scrollIntoView({ behavior: 'smooth' });
                })
                .catch(() => { if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader(); });
            },
            submit: function(isUpdate) {
                var title = document.querySelector('.ipt-title').value.trim();
                if (!title) { showToast('Vui lòng nhập tiêu đề', 'error'); return; }
                var content = _quill ? _quill.getText().trim() : '';
                var url = isUpdate ? '/admin/news/' + _editingId : '/admin/news';
                var body = new URLSearchParams({ _token: CSRF, category: document.querySelector('.sl-category').value, title: title, content: content });
                if (isUpdate) body.append('_method', 'PUT');
                if (typeof showFullScreenLoader === 'function') showFullScreenLoader('', '');
                fetch(url, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/x-www-form-urlencoded' }, body: body.toString() })
                .then(r => r.json())
                .then(data => {
                    if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                    if (data.success) {
                        document.querySelector('.div-form').style.display = 'none';
                        showToast(isUpdate ? 'Cập nhật thành công' : 'Thêm thành công', 'success');
                        setTimeout(() => location.reload(), 600);
                    } else { showToast(data.message || 'Lỗi', 'error'); }
                })
                .catch(() => { if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader(); showToast('Lỗi kết nối', 'error'); });
            },
            delete: function(id) {
                document.getElementById('modal-confirm-body').textContent = 'Bạn có chắc muốn xóa thông báo này?';
                var modal = new bootstrap.Modal(document.getElementById('modal-confirm'));
                modal.show();
                var btnOk = document.getElementById('btn-modal-confirm-ok');
                var newBtn = btnOk.cloneNode(true);
                btnOk.parentNode.replaceChild(newBtn, btnOk);
                newBtn.addEventListener('click', function() {
                    modal.hide();
                    if (typeof showFullScreenLoader === 'function') showFullScreenLoader('', '');
                    fetch('/admin/news/' + id, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/x-www-form-urlencoded' }, body: '_token=' + CSRF + '&_method=DELETE' })
                    .then(r => r.json())
                    .then(data => {
                        if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                        if (data.success) { var row = document.getElementById('news-row-' + id); if (row) row.remove(); showToast('Đã xóa thành công', 'success'); }
                        else { showToast(data.message || 'Lỗi', 'error'); }
                    })
                    .catch(() => { if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader(); });
                });
            }
        }
    }
};
</script>
@endsection
