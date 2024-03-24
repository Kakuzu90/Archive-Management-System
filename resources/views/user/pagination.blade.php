@if ($paginator->hasPages())
<div class="d-flex justify-content-end align-items-center">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-rounded pagination-outline-primary">
        @if ($paginator->onFirstPage())
            <li class="page-item first disabled">
                <a class="page-link" href="javascript:void(0);"
                  ><i class="tf-icon mdi mdi-chevron-double-left"></i></a>
            </li>
        @else
            <li class="page-item prev">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                  ><i class="tf-icon mdi mdi-chevron-double-left"></i></a>
            </li>
        @endif
    
        <li class="page-item active">
            <a class="page-link" href="javascript:void(0);">{{ $paginator->currentPage() }}</a>
        </li>
          
        @if ($paginator->hasMorePages())
            <li class="page-item next">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                    ><i class="tf-icon mdi mdi-chevron-double-right"></i></a>
            </li>
        @else
            <li class="page-item last disabled">
                <a class="page-link" href="javascript:void(0);"
                ><i class="tf-icon mdi mdi-chevron-double-right"></i></a>
            </li>
        @endif
    
        </ul>
    </nav>
</div>
@endif