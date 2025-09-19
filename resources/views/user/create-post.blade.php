<!DOCTYPE html>
<html lang="en">
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        const userToken = localStorage.getItem('user_token');
        if (!userToken) {
            window.location.href = '/';
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
                        <h4>Create Post</h4>
                    </div>
                    <!-- Create post form -->
                    <div class="card-body">
                        <form id="createPostForm">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
                            </div>
                            <div id="postAlert" class="alert d-none" role="alert"></div>
                            <button type="submit" class="btn btn-success w-100" id="createPostBtn">Create Post</button>
                        </form>

                    <div class="text-center mt-4">
                        <a href="/" class="btn btn-primary">Go Home</a>
                    </div> 
                </div>
            </div>
        </div>
        
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ajax script to create post -->
    <script>
        $(function() {
            $('#createPostForm').on('submit', function(e) {
                e.preventDefault();
                $('#createPostBtn').prop('disabled', true);
                $('#postAlert').removeClass('alert-success alert-danger').addClass('d-none').text('');
                
                const userToken = localStorage.getItem('user_token');
                if (!userToken) {
                    $('#postAlert').removeClass('d-none').addClass('alert-danger').text('You must be logged in to create a post.');
                    $('#createPostBtn').prop('disabled', false);
                    return;
                }

                $.ajax({
                    url: '/api/user/posts',
                    method: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'Authorization': `Bearer ${userToken}`
                    },
                    data: JSON.stringify({
                        title: $('#title').val(),
                        content: $('#body').val()
                    }),
                    success: function(response) {
                        $('#postAlert').removeClass('d-none').addClass('alert-success').text('Post created successfully!');
                        $('#createPostForm')[0].reset();
                        setTimeout(() => {
                            window.location.href = `/posts/${response.data.id}`;
                        }, 1500);
                    },
                    error: function(xhr) {
                        let errorMessage = 'Failed to create post.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $('#postAlert').removeClass('d-none').addClass('alert-danger').text(errorMessage);
                    },
                    complete: function() {
                        $('#createPostBtn').prop('disabled', false);
                    }
                });
            });
        });
        </script>
</body>

</html>