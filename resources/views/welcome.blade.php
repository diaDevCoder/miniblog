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
        <h1 class="mb-4">Blog Posts</h1>
        <p class="mb-4">Most Recent</p>
        <div class="mb-4">        
             <script>
                function logout() {
                    localStorage.removeItem('user_token');
                    window.location.href = '/';
                }

                const userToken = localStorage.getItem('user_token');
                if (userToken) {
                    document.write('<a href="/user/create-post" class="btn btn-success me-2">Create Post</a>');
                    document.write('<button type="button" onclick="logout()" class="btn btn-danger me-2">Logout</button>');
                }else {
                    document.write('<a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>');
                }
            </script>
        </div>
        <div id="posts-row" class="row"></div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/posts',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    let postsHtml = '';
                    if (!response.data || !response.data.data || response.data.data.length === 0) {
                        postsHtml = `
                            <div class="col-12">
                                <p class="text-center text-muted">No posts available.</p>
                            </div>
                        `;
                    } else {
                        $.each(response.data.data, function(i, post) {
                            postsHtml += `
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">${post.title}</h5>
                                            <p class="card-text">${post.body && post.body.length > 80 ? post.body.substring(0, 77) + '...' : (post.body || '')}</p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                By ${post.author ? post.author : 'Unknown'}
                                            </small>
                                            <small class="text-muted">
                                                ${post.created_at ? new Date(post.created_at).toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' }) : ''}
                                            </small>
                                            <a href="/posts/${post.id}" class="btn btn-sm btn-outline-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    }
                    $('#posts-row').html(postsHtml);
                },
                error: function() {
                    $('#posts-row').html('<div class="col-12"><p class="text-center text-danger">Failed to load posts.</p></div>');
                }
            });            
        });
        </script>
</body>

</html>