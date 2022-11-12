<?php

namespace App\Policies;

use App\Models\Phod;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy {
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function update(Tag $user, tag $tag, Phod $phod) {
        // return $phod->id === $tag->phod_id;
    }

    public function delete(Tag $user, tag $tag, Phod $phod) {
        // return $phod->id === $tag->phod_id;
    }
}
