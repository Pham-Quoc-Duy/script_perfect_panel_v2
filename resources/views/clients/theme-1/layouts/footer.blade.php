<div id="notify">
    <span id="notifyText">
        <i class=""></i>
        <span class="text"></span>
    </span>
</div>

<!-- avatar -->
<div class="modal fade" id="avatarModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="avatarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-icon">
                    <i class="far fa-user"></i>
                </div>
                <h5 class="modal-title">Select Avatar</h5>
                <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body avatar-list" id="avatar-list">
                <div class="avatar-item active" data-avatar="1">
                    <img src="https://storage.perfectcdn.com/j71eqe/9ux9lbtkpqgitpjw.png" class="avatar" alt="Avatar 1">
                </div>
                <div class="avatar-item" data-avatar="2">
                    <img src="https://storage.perfectcdn.com/j71eqe/4ug7klaskcd13rzg.png" class="avatar" alt="Avatar 2">
                </div>
                <div class="avatar-item" data-avatar="3">
                    <img src="https://storage.perfectcdn.com/j71eqe/fsai26g7j0mh6msl.png" class="avatar" alt="Avatar 3">
                </div>
                <div class="avatar-item" data-avatar="4">
                    <img src="https://storage.perfectcdn.com/j71eqe/jt77hrfbuty69ejf.png" class="avatar" alt="Avatar 4">
                </div>
                <div class="avatar-item" data-avatar="5">
                    <img src="https://storage.perfectcdn.com/j71eqe/rmd67ygnz97geyyu.png" class="avatar" alt="Avatar 5">
                </div>
                <div class="avatar-item" data-avatar="6">
                    <img src="https://storage.perfectcdn.com/j71eqe/1lek6noug0pfexgu.png" class="avatar" alt="Avatar 6">
                </div>
                <div class="avatar-item" data-avatar="7">
                    <img src="https://storage.perfectcdn.com/j71eqe/h1k22cdxroc3cogd.png" class="avatar" alt="Avatar 7">
                </div>
                <div class="avatar-item" data-avatar="8">
                    <img src="https://storage.perfectcdn.com/j71eqe/m3b4tiojdonxkios.png" class="avatar" alt="Avatar 8">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary w-100" data-dismiss="modal" aria-label="Close">
                    <span>Close</span>
                </button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
{{-- jQuery (luôn load đầu tiên) --}}
<script src="{{ asset('template/js/jquery.min.js') }}"></script>

{{-- Global scripts --}}
<script src="{{ asset('template/js/fgks9m94k0nhqmix.js') }}"></script>
<script src="{{ asset('template/js/8gmoznjnttfyk1mz.js') }}"></script>
<script src="{{ asset('template/js/w8l498eitwhkze7w.js') }}"></script>
<script src="{{ asset('template/js/jq8derbjf313z5ai.js') }}"></script>
<script src="{{ asset('template/js/0ud5szi4ocdmm9ep.js') }}"></script>

{{-- Page specific --}}
<script src="{{ asset('template/js/kmrhwytcnx2ms6up.js') }}"></script>
<script src="{{ asset('template/js/os8r133zojpct6tf.js') }}"></script>



<script>
    $('.form-control').on('select2:open', function(event) {
        $('.select2-search input').prop('focus', false);
    });
    $(document).ready(function() {
        const sPassive = 'sidebarPassive';
        if (localStorage.getItem(sPassive) === 'true') {
            $('body').addClass('sidebar-passive');
        }
        $('.menu-toggle').on('click', function() {
            $('body').toggleClass('sidebar-passive');
            const isPassive = $('body').hasClass('sidebar-passive');
            localStorage.setItem(sPassive, isPassive);
        });
        $('a[href="/logout"]').on('click', function(e) {
            e.preventDefault();
            localStorage.removeItem(sPassive);
            window.location.href = '/logout';
        });
    });
</script>

{{-- Custom Footer Scripts --}}
  {!! $config->script_footer ?? '' !!}

</body>

</html>
