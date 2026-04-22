{{-- Session-based alerts using AlertifyJS --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            alertify.success('{!! addslashes(session('success')) !!}');
        @endif

        @if(session('error'))
            alertify.error('{!! addslashes(session('error')) !!}');
        @endif

        @if(session('warning'))
            alertify.warning('{!! addslashes(session('warning')) !!}');
        @endif

        @if(session('info'))
            alertify.message('{!! addslashes(session('info')) !!}');
        @endif

        @if(session('primary'))
            alertify.notify('{!! addslashes(session('primary')) !!}', 'custom', 5);
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                alertify.error('{!! addslashes($error) !!}');
            @endforeach
        @endif
    });
</script>