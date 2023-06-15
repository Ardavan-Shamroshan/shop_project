@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @forelse ($errors->all() as $error)
                <li>{{ $error }}</li>
            @empty
@endforelse
        </ul>
    </div>
@endif
