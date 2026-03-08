<div class="wsus__support_tecket_footer">
    <ul class="d-flex">

        @if ($paginator->onFirstPage())
        @else
            <li><a class="common_btn" href="{{ $paginator->previousPageUrl() }}">{{ __('Previous') }}</a></li>
        @endif

        @if ($paginator->hasMorePages())
            <li><a class="common_btn" href="{{ $paginator->nextPageUrl() }}">{{ __('next') }}</a></li>
        @endif

    </ul>
</div>
