
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

@livewireScripts
</body>

</html>
