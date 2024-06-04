@props([
    'viewed' => false,
    'calificado' => false
])

<div class="col-6 col-md-4 col-xl-4 col-xxl-3">
    <div class="app-card app-card-doc shadow-sm h-100">
        <div class="app-card-thumb-holder p-3">
            <span class="icon-holder text-info">
                <i class="fa-solid fa-file-invoice-dollar"></i>
            </span>

            @if ($viewed)
                <span class="badge bg-success">NEW</span>
            @endif

            <a class="app-card-link-mask" href="#file-link"></a>
        </div>
        <div class="app-card-body p-3 has-card-actions">

            <h4 class="app-doc-title truncate mb-0"><a href="#file-link">
                {{ $title ?? 'Doc' }}
            </a></h4>
            <div class="app-doc-meta">
                <ul class="list-unstyled mb-0">
                    <li><span class="text-muted">Autor:</span> {{ $autor ?? 'Docente' }}</li>
                    <li><span class="text-muted">Subido:</span> {{ $created_at ?? '--/--/----' }}

                    @if ($calificado)
                        <li><span class="text-muted">Calificación:</span> {{ $nota ?? '' }}
                    @endif
                    </li>
                </ul>
            </div><!--//app-doc-meta-->
        </div><!--//app-card-body-->
    </div><!--//app-card-->
</div><!--//col-->