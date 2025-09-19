<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div id="post-content"></div>        
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Get post id from url
            const pathParts = window.location.pathname.split('/');
            const postId = pathParts[pathParts.length - 1];

            $.ajax({
                url: `/api/posts/${postId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    let postHtml = '';
                    if (!response.data || response.data.length === 0) {
                        postHtml = `
                            <div class="alert alert-warning text-center">
                                No post found.
                            </div>
                        `;
                    } else {
                        const post = response.data[0];
                        postHtml = `
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h2 class="card-title">${post.title}</h2>
                                    <p class="card-text">${post.body ? post.body.replace(/\n/g, '<br>') : ''}</p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        By ${post.author ? post.author : 'Unknown'}
                                    </small>
                                    <small class="text-muted">
                                        ${post.created_at ? new Date(post.created_at).toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' }) : ''}
                                    </small>
                                </div>
                            </div>
                        `;
                    }
                    $('#post-content').html(postHtml);
                },
                error: function() {
                    $('#post-content').html(`
                        <div class="alert alert-danger text-center">
                            Post not found.<br>
                            <a href="/" class="btn btn-primary mt-3">Go Home</a>
                        </div>
                    `);
                }
            });
        });
    </script>
</body>

</html>