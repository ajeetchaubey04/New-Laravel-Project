<div id="loader-div">
        <div class="loader"></div>
</div>

@push('js')
        <script>
                function showLoader() {
                        document.getElementById('loader-div').classList.add('show');
                }
                function hideLoader() {
                        setTimeout(() => {
                                document.getElementById('loader-div').classList.remove('show');
                        }, 1500);
                }
        </script>
@endpush

