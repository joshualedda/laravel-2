
<script>
    $(document).ready(function() {
                var message = $('#message');
                if (message.length) {
                    message.fadeIn(500);
                    setTimeout(function() {
                        message.fadeOut(500);
                    }, 3000); // Change the duration (in milliseconds) as needed
                }
            });
</script>

  <!-- Vendor JS Files -->
  {{-- <script src="assets/vendor/apexcharts/apexcharts.min.js"></script> --}}
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  {{-- <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script> --}}

  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
@livewireScripts
</body>

</html>
