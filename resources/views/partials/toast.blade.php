@push('js')
    <!-- Toaster Alerts Js Cdn-->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        function toaster(message, priority) {
            const notyf = new Notyf({
                duration: 2000,
                position: {
                    x: 'right',
                    y: 'top',
                },
                ripple: true,
                dismissible: true
            });
            if (priority == 'success') {
                setTimeout(() => {
                    notyf.success(message);
                }, 1000);
            }
            if (priority == 'error') {
                setTimeout(() => {
                    notyf.error(message);
                }, 1000);

            }
        }
    </script>

    @if (Session::has('error'))
        <script>
            toaster("{{ Session::get('error') }}", 'error');
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            toaster("{{ Session::get('success') }}", 'success');
        </script>
    @endif

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>
                toaster("{{ $error }}", 'error');
            </script>
        @endforeach
    @endif

@endpush
