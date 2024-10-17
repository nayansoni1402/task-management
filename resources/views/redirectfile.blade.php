<!DOCTYPE html>
<html>
<head>
    <title>Login as Role</title>
    <script>
        window.onload = function() {
            const userId = '{{ $userId }}';
            const role = '{{ $role }}'; 
            const url = '/tasks'; 

            const newWindow = window.open(url + '?role=' + role + '&user_id=' + userId, '_blank');
            if (newWindow) {
                newWindow.focus();
            } else {
                alert('Please allow popups for this website.');
            }

            // window.location.href = '{{ route('tasks.index') }}';
        }
    </script>
</head>
<body>
    <p>Logging in as {{ $role }}...</p>
</body>
</html>
