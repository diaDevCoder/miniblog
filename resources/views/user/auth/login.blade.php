<!DOCTYPE html>
<html lang="en">
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        const userToken = localStorage.getItem('user_token');
        if (userToken) {
            window.location.href = '/user/create-post';
        }
    });
    </script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4>User Login</h4>
                    </div>
                    <div class="card-body">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required autocomplete="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                            </div>
                            <div id="loginAlert" class="alert d-none" role="alert"></div>
                            <button type="submit" class="btn btn-primary w-100" id="loginBtn">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                $('#loginBtn').prop('disabled', true);
                $('#loginAlert').removeClass('alert-success alert-danger').addClass('d-none').text('');
                $.ajax({
                    url: '/api/user/login',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        email: $('#email').val(),
                        password: $('#password').val()
                    }),
                    success: function(res) {
                        if (!res.error) {
                            $('#loginAlert').removeClass('d-none alert-danger').addClass('alert-success').text(res.message);
                            localStorage.setItem('user_token', res.data.token);
                            setTimeout(function() {
                                window.location.href = '/user/create-post';
                            }, 1200);
                        } else {
                            $('#loginAlert').removeClass('d-none alert-success').addClass('alert-danger').text(res.message);
                        }
                    },
                    error: function(xhr) {
                        let msg = 'Login failed. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                        $('#loginAlert').removeClass('d-none alert-success').addClass('alert-danger').text(msg);
                    },
                    complete: function() {
                        $('#loginBtn').prop('disabled', false);
                    }
                });
            });
        });
        </script>
</body>

</html>