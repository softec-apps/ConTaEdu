@props([
    'name',
    'title' => '',
    'show' => false,
    'form' => false,
    'form_action' => '#',
    'form_method' => 'post',
    'form_enctype' => 'application/x-www-form-urlencoded',
    'submit_text' => 'Guardar',
    'size' => 'lg'
])

<div class="modal fade" id="{{ $name }}" tabindex="-1" aria-labelledby="{{ $name }}Label" aria-hidden="true"
    x-data="{
        isOpen: @js($show),
        toggleModal() {
            if (this.isOpen) {
                $('#{{ $name }}').modal('show');
            } else {
                $('#{{ $name }}').modal('hide');
            }
        }
    }" x-init="() => {
        toggleModal();
        $watch('isOpen', () => toggleModal());
        $('#{{ $name }}').on('shown.bs.modal', () => isOpen = true);
        $('#{{ $name }}').on('hidden.bs.modal', () => isOpen = false);
    }">
    <div class="modal-dialog modal-{{ $size }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $name }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($form)
                    <form action="{{ $form_action }}" id="{{ $name }}Form" method="{{ $form_method }}" enctype="{{ $form_enctype }}">
                        @csrf
                        {{ $slot }}
                    </form>
                @else
                    {{ $slot }}
                @endif
            </div>
            @if ($form && !isset($footer))
                <div class="modal-footer">
                    <x-secondary-button data-bs-dismiss="modal">Cancelar</x-secondary-button>
                    <x-primary-button form="{{ $name }}Form" type="submit">{{ $submit_text }}</x-primary-button>
                </div>
            @endif
            @if (isset($footer))
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
