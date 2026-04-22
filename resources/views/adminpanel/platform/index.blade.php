<div class="modal fade" tabindex="-1" id="modal-platform" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="mb-5">
                    <label class="required form-label" data-lang="Name">Tên</label>
                    <input type="text" class="form-control form-control-solid ipt-platform-name">
                </div>
                <div class="mb-5">
                    <label class="required form-label" data-lang="Icon">Biểu tượng hoặc hình ảnh</label>
                    <div class="input-group input-group-solid">
                        <input type="text" class="form-control ipt-platform-icon"
                            onkeyup="_categories.on.keyup.icon(this.value)"
                            placeholder="fa-brands fa-youtube || image link">
                        <span class="input-group-text platform-icon"></span>
                    </div>
                </div>
                <div class="text-muted fst-italic"><span data-lang="">Tham khảo biểu tượng mẫu</span>: <a
                        href="https://fontawesome.com/search?o=r&amp;m=free" target="_blank" data-lang="">Tại đây</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"
                    data-lang="button::Close">Đóng</button>
                <button type="button" class="btn btn-primary btn-sm">Add</button>
            </div>
        </div>
    </div>
</div>
