@if ($paginator->hasPages())
<ul class="pagination justify-content-center my-4">

    {{-- Boton Previo --}}
    @if ($paginator->onFirstPage())
    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previo</a></li>
    @else
    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1"
            aria-disabled="true">Previo</a></li>
    @endif

    {{-- Elementos del paginador --}}
    @foreach ($elements as $element)

    {{-- Separador: 3 puntitos --}}
    @if (is_string($element))
    <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
    @endif

    {{-- Elementos del Array --}}
    @if (is_array($element))
    @foreach ($element as $page=>$url)
    @if ($page === $paginator->currentPage())
    <li class="page-item active" aria-current="page"><a class="page-link" href="#!">{{ $page }}</a></li>
    @else
    <li class="page-item" aria-current="page"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Boton Siguiente --}}
    @if ($paginator->hasMorePages())
    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Siguientes</a></li>
    @else
    <li class="page-item disabled"><a class="page-link" href="#">Siguientes</a></li>
    @endif
</ul>
@endif
