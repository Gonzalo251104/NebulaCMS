<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('posts.view');
    }

    public function create(User $user): bool
    {
        return $user->can('posts.create');
    }

    public function update(User $user, Post $post): bool
    {
        // If it has edit permission (editor/admin), can edit any post
        if ($user->can('posts.edit')) {
            return true;
        }

        // Author case: only their own posts
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post): bool
    {
        // If it has delete permission (editor/admin), can delete any post
        if ($user->can('posts.delete')) {
            return true;
        }

        // Author case: only their own posts
        return $user->id === $post->user_id;
    }
}
