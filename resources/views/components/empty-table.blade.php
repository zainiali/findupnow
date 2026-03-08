<tr>
    <td class="py-5 text-center" colspan="{{ $colspan }}">
        <img src="{{ asset('backend/img/empty-box.webp') }}" alt="" width="200px">
        <h4 class="py-2">{{ $message }}</h4>
        @if ($create == 'yes')
            <a class="btn btn-success " href="{{ route($route) }}">{{ __('Add New') }} {{ $name }}</a>
        @endif
    </td>
</tr>
