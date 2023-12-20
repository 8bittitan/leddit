<?php

use function Laravel\Folio\{middleware};

middleware(['auth']);

?>

<x-app-layout>
    @volt
    <livewire:components.post.submit/>
    @endvolt
</x-app-layout>
