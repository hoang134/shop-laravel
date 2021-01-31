<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Constant;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Helpers\HelpersFun;
use App\Models\Post;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', Post::class);
        $posts = $this->postRepository->getAndPaginate(10);
        return view('backend.modules.posts.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);
        return view('backend.modules.posts.add');

    }

    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class);
        $data = $request->except('_token', 'url_image');
        $data['url_post'] = saveUrl($request->title);
        $data['user_id'] = auth()->id();
        if($request->hasFile('url_image')) {
            $image = HelpersFun::getNameImage($request->file('url_image'), 'posts', $data['url_post']);
            $data['url_image'] = $image;
        }
        try {
            $this->postRepository->create($data);
            return redirect()->route('posts.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }

    }

    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        if(!$post) {
            return redirect()->route('posts.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('update', $post);
        return view('backend.modules.posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->postRepository->find($id);
        if(!$post) {
            return redirect()->route('posts.index')->with('danger', __('messages.general.error'));
        }

        $this->authorize('update', $post);

        $data = $request->except('_token', 'url_image');
        $data['url_post'] = saveUrl($request->title);
        $data['user_id'] = auth()->id();
        if($request->hasFile('url_image')) {
            HelpersFun::deleteImage(storage_path('/app/public/') . $post->url_image);
            $image = HelpersFun::getNameImage($request->file('url_image'), 'posts', $data['url_post']);
            $data['url_image'] = $image;
        }

        try {
            $post->update($data);
            return redirect()->route('posts.index')->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function destroy($id)
    {
        $post = $this->postRepository->find($id);
        if(!$post) {
            return redirect()->route('posts.index')->with('danger', __('messages.general.not_found'));
        }
        $this->authorize('delete', $post);

        try {
            $this->postRepository->update($id, ['status' => Constant::STATUS_DELETED]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }

    public function restore($id)
    {
        $this->authorize('restore', Post::class);
        $post = $this->postRepository->find($id);
        if(!$post) {
            return redirect()->route('posts.index')->with('danger', __('messages.general.not_found'));
        }

        try {
            $this->postRepository->update($id, ['status' => Constant::STATUS_ACTIVE]);
            return redirect()->back()->with('success', __('messages.general.success'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', __('messages.general.error'));
        }
    }
}
