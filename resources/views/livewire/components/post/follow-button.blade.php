<?php

use App\Models\User;
use App\Models\Sub;

use function Livewire\Volt\{mount, state};

state(['is_following', 'user', 'sub']);

mount(function (User $user, Sub $sub) {
    $this->user = $user;
    $this->sub = $sub;
    $this->is_following = $user->followsSub($sub);
});

$handleFollow = function () {
    $this->user->toggleFollowSub($this->sub);
    $this->is_following = !$this->is_following;
};

?>

<x-secondary-button class="justify-center text-center group" wire:click="handleFollow">
    @if ($is_following)
        <span class="block group-hover:hidden">Joined</span>
        <span class="hidden group-hover:block">Leave</span>
    @else
        <span>Follow</span>
    @endif
</x-secondary-button>
