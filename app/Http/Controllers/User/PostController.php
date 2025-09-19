<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Summary of index
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $posts = $request->user()->posts()
        ->when($request->search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        })
        ->latest()->get();
        return $this->success('Posts retrieved successfully.', $posts);
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = $request->user()->posts()->create($request->validated());
        return $this->success('Post created successfully.', $post);
    }

    /**
     * Summary of show
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request, $id)
    {
        $post = $request->user()->posts()->find($id);
        if (! $post) {
            return $this->notFound('Post not found.');  
        }
        
        return $this->success('Post retrieved successfully.', $post);
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = $request->user()->posts()->find($id);
        if (! $post) {
            return $this->notFound('Post not found.');  
        }

        $post->update($request->validated());
        return $this->success('Post updated successfully.', $post);
    }

    /**
     * Summary of destroy
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = $request->user()->posts()->find($id);
        if (! $post) {
            return $this->notFound('Post not found.');  
        }

        $post->delete();
        return $this->success('Post deleted successfully.');
    }
}
