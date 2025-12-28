@if(session('success'))
    <div class="mb-4 p-4 rounded bg-green-50 border border-green-100 text-green-700">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 rounded bg-red-50 border border-red-100 text-red-700">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-4 p-4 rounded bg-yellow-50 border border-yellow-100 text-yellow-800">
        <ul class="list-disc ml-5">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
