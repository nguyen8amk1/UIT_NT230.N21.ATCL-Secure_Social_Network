<?php

namespace App\Http\Livewire\Posts;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Auth;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class View extends Component
{
    use WithPagination;

    public $comments = [];
    public $comment;
    public $type;
    public $queryType;
    public $postId;
    public $deletePostId;
    public $isOpenCommentModal = false;
    public $isOpenDeletePostModal = false;

    public function mount($type = null)
    {
        $this->queryType = $type;
    }

    public function render()
    {
        $posts = $this->setQuery();

        return view('livewire.posts.view', ['posts' => $posts]);
    }

    public function incrementLike(Post $post)
    {
        $like = Like::where('user_id', Auth::id())
                    ->where('post_id', $post->id);

        if (!$like->count()) {
            Like::create([
                'post_id' => $post->id,
                'user_id' => Auth::id(),
            ]);
        } else {
            $like->delete();
        }
    }

    public function comments($post)
    {
        $post = Post::with(['comments.user' => function ($query) {
            $query->select('id', 'name');
        }])->findOrFail($post);

        $this->postId = $post->id;
        $this->resetValidation('comment');
        $this->isOpenCommentModal = true;
        $this->setComments($post);
    }

    public function createComment(Post $post)
    {
        // Removing validation for demonstration purposes
        // $validatedData = Validator::make(
        //     ['comment' => $this->comment],
        //     ['comment' => 'required|max:5000']
        // )->validate();

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'comment' => $this->comment, // No sanitization
        ]);

        session()->flash('comment.success', 'Comment created successfully');

        $this->setComments($post);
        $this->comment = '';

        return redirect()->back();
    }

    public function setComments($post)
    {
        $this->comments = $post->comments;
    }

    public function showDeletePostModal(Post $post)
    {
        $this->deletePostId = $post->id;
        $this->isOpenDeletePostModal = true;
    }

    public function deletePost(Post $post)
    {
        // Removing authorization for demonstration purposes
        // $response = Gate::inspect('delete', $post);

        // if ($response->allowed()) {
        try {
            $post->delete();
            session()->flash('success', 'Post deleted successfully');
        } catch (Exception $e) {
            session()->flash('error', 'Cannot delete post: ' . $e->getMessage());
        }
        // } else {
        //     session()->flash('error', $response->message());
        // }

        $this->isOpenDeletePostModal = false;
        return redirect()->back();
    }

    public function deleteComment(Post $post, Comment $comment)
    {
        // Removing authorization for demonstration purposes
        // $response = Gate::inspect('delete', [$comment, $post]);

        // if ($response->allowed()) {
        try {
            $comment->delete();
            session()->flash('success', 'Comment deleted successfully');
        } catch (Exception $e) {
            session()->flash('comment.error', 'Cannot delete comment: ' . $e->getMessage());
        }
        // } else {
        //     session()->flash('comment.error', $response->message());
        // }

        $this->isOpenCommentModal = false;
        return redirect()->back();
    }

    private function setQuery()
    {
        $user = Auth::user();

        $query = Post::withCount(['likes', 'comments'])
            ->with(['userLikes', 'postImages', 'user' => function ($query) {
                $query->select(['id', 'name', 'username', 'profile_photo_path']);
            }])
            ->latest();

        if ($this->queryType === 'me') {
            $query->where('user_id', $user->id);
        } elseif ($this->queryType === 'followers') {
            $userIds = $user->followings()->pluck('follower_id')->push($user->id);
            $query->whereIn('user_id', $userIds);
        }

        return $query->paginate(10);
    }
}

