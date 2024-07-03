@props(['items' => []])

<div x-data="{ isLoading: true, hasContent: @json(count($items) > 0) }" x-init="isLoading = false">
    <!-- Loader visible while loading -->
    <x-loader x-show="isLoading" />
    <!-- Message to show if no content -->
    <p x-show="!isLoading && !hasContent" x-cloak class="text-center">Nada por el momento</p>

    <!-- Content to show if has content -->
    <template x-if="!isLoading && hasContent">
        <div>
            @if (isset($items_code))
                {{ $items_code }}
            @else
                @foreach ($items as $item)
                    <x-card-item :exercise="$item"></x-card-item>
                @endforeach
            @endif
        </div>
    </template>

    <div x-show="!isLoading">
        {{ $slot }}
    </div>
</div>