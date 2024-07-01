@props(['messages' => []])

<!-- @if ($messages)
    <ul {{ $attributes->merge(['class' => 'error-msg']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif -->
<div x-data="{
        messages: @js($messages),
        setMessages(newMessages) {
            this.messages = newMessages;
            this.hasErrors = newMessages.length > 0;
        },
        clearMessages() {
            this.messages = [];
            this.hasErrors = false;
        },
        hasErrors: @js(count($messages) > 0)
    }"
    x-show="hasErrors"
    {{ $attributes->merge(['class' => '']) }}
    style="display: none;">
    <ul class="error-msg">
        <template x-for="message in messages" :key="message">
            <li x-text="message"></li>
        </template>
    </ul>
</div>