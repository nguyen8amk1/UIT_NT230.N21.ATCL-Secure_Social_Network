<?php

namespace App\Http\Livewire\Posts;

use App\Models\Media;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Stevebauman\Location\Facades\Location;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $body;
    public $file;
    public $location;

    public function mount()
    {
        $ipAddress = $this->getIp();
        $position = Location::get($ipAddress);

        if ($position) {
            $this->location = $position->cityName . '/' . $position->regionCode;
        } else {
            $this->location = null;
        }
    }

    public function submit()
    {
        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'location' => $this->location,
            'body' => $this->body,
        ]);

        $this->storeFiles($post);

        session()->flash('success', 'Post created successfully');

        return redirect('home');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.posts.create');
    }

    private function storeFiles($post)
    {
        if (empty($this->file)) {
            return true;
        }

        $originalFilename = $this->file->getClientOriginalName();
        $path = $this->file->storeAs('post-photos', $originalFilename, 'public');

        Media::create([
            'post_id' => $post->id,
            'path' => $path,
            'is_image' => true, // Assuming all files are images for demo
        ]);
    }

    private function getIp(): ?string
    {
        foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    return $ip;
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}