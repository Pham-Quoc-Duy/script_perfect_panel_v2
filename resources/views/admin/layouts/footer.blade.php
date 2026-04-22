<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © Minia.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<!-- Core JavaScript -->
<script src="{{ asset('template-admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('template-admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('template-admin/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('template-admin/js/simplebar.min.js') }}"></script>
<script src="{{ asset('template-admin/js/waves.min.js') }}"></script>
<script src="{{ asset('template-admin/js/feather.min.js') }}"></script>
<script src="{{ asset('template-admin/js/pace.min.js') }}"></script>

<!-- Utility JavaScript -->
<script src="{{ asset('template-admin/js/flatpickr.min.js') }}"></script>
<script src="{{ asset('template-admin/js/alertify.min.js') }}"></script>

<!-- DataTables JavaScript -->
<script src="{{ asset('template-admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template-admin/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template-admin/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template-admin/js/responsive.bootstrap4.min.js') }}"></script>

<!-- External Libraries -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<!-- App Initialization -->
<script src="{{ asset('template-admin/js/notification.init.js') }}"></script>
<script src="{{ asset('template-admin/js/invoices-list.init.js') }}"></script>
<script src="{{ asset('template-admin/js/app.js') }}"></script>

<!-- Hide Page Loader -->
<script>
    // Hide loader when page is fully loaded
    window.addEventListener('load', function() {
        const loader = document.getElementById('pageLoader');
        if (loader) {
            setTimeout(function() {
                loader.classList.add('hidden');
            }, 300);
        }
    });

    // Also hide loader if page is already loaded (for cached pages)
    if (document.readyState === 'complete') {
        const loader = document.getElementById('pageLoader');
        if (loader) {
            loader.classList.add('hidden');
        }
    }
</script>

<!-- DataTable Initialization -->
<script>
    function initializeDataTable() {
        if (!$.fn.DataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable({
                pageLength: 25,
                responsive: true,
                order: [
                    [1, 'asc']
                ],
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: [0, -1]
                }],
                language: {
                    search: "Tìm kiếm:",
                    lengthMenu: "Hiển thị _MENU_ mục",
                    info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    paginate: {
                        next: "Tiếp",
                        previous: "Trước"
                    },
                    emptyTable: "Không có dữ liệu"
                }
            });
        }
    }

    // Language Switcher
    document.querySelectorAll('.language').forEach(el => {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            const lang = this.getAttribute('data-lang');
            fetch('/api/language/switch', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ language: lang })
            }).then(() => window.location.reload());
        });
    });
</script>

<!-- Page-specific Scripts -->
@stack('scripts')

</body>

</html>
