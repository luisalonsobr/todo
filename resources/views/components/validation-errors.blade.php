@if ($errors->any())
    <div {{ $attributes }}>
        <ul class="mt-3 p-3 list-disc list-inside text-sm bg-red-700 text-gray-100 divide-y">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
