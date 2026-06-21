<form id="logout-form"
      action="{{ route('logout') }}"
      method="POST"
      style="display:none;">
    @csrf
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutButtons = document.querySelectorAll('.logout-button');

        logoutButtons.forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById('logout-form').submit();
            });
        });
    });
</script>