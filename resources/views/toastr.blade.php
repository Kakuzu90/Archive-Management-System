<script>

    @if (Session::get('status'))
        toastr['success']('You have successfully logged in to Capstone Project Hub. Now you can start to explore!', '👋 Welcome back {{ auth()->user()->fullname }}!', {
            positionClass: 'toast-bottom-right',
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            rtl: false
        });
    @endif

    @if ($message = Session::get('success'))
        toastr['success']('{{ $message[1] }}', '{{ $message[0] }}', {
            positionClass: 'toast-bottom-right',
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            rtl: false
        });
    @endif

    @if ($message = Session::get('info'))
        toastr['warning']('{{ $message[1] }}', '{{ $message[0] }}', {
            positionClass: 'toast-bottom-right',
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            rtl: false
        });
    @endif

    @if ($message = Session::get('danger'))
        toastr['error']('{{ $message[1] }}', '{{ $message[0] }}', {
            positionClass: 'toast-bottom-right',
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            rtl: false
        });
    @endif

    @error("verify")
    toastr['error']('{{ $message }}', 'Password Error!', {
            positionClass: 'toast-bottom-right',
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            rtl: false
        });
    @enderror

</script>