@props([
    'custom' => false,
    'loading' => false
])

<button x-data="{
        text: $el.innerHTML,
        loading: @js($loading),
        disabled: false,
    }" x-bind:disabled="loading || disabled"
    x-html="loading ? '<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span> Buscando...' : text"
    {{ $attributes->merge(['type' => 'button', 'class' => $custom ? 'btn' : 'btn btn-primary text-white']) }}>
    {{ $slot }}
</button>
