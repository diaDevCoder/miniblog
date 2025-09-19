<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Summary of __construct
     * @param \App\Models\Post $post
     */
    public function __construct(public Post $post) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->post->query()
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
            })
            ->with('user:id,username')
            ->latest()
            ->get();

           $posts = $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'body' => $post->content,
                    'author' => $post->user->username,
                    'created_at' => $post->created_at->toDateTimeString(),
                    'last_updated_at' => $post->updated_at->toDateTimeString(),
                ];
            });

            $perPage = $request->input('per_page', 15);
            $page = $request->input('page', 1);

            $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                $posts->forPage($page, $perPage),
                $posts->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );

            $posts = $paginator;


        return $this->success('Posts retrieved successfully.', $posts);
    }

    /**
     * Summary of show
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        $getPost = $this->post->find($id);
        if (! $getPost) {
            return $this->notFound('Post not found.');
        }

        $getPost->load('user:id,username');
        
        // Wrap the single post in a collection to use map
        $getPost = collect([$getPost]);

        $getPost = $getPost->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->content,
                'author' => $post->user->username,
                'created_at' => $post->created_at->toDateTimeString(),
                'last_updated_at' => $post->updated_at->toDateTimeString(),
            ];
        });

        return $this->success('Post retrieved successfully.', $getPost);
    }
}
