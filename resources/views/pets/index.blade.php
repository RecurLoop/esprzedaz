<h1>Pets</h1>

<a href="{{ route('pets.create') }}"
   style="display:inline-block; margin-bottom:10px; padding:6px 12px; background:#28a745; color:white; text-decoration:none; border-radius:4px;">
   Add Pet
</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
@if($errors->any())
    <p style="color:red">{{ $errors->first() }}</p>
@endif

<table border="1" cellspacing="0" style="border-collapse: collapse; width:100%; table-layout: fixed;">
    <thead style="background:#f9f9f9;">
        <tr>
            <th style="width:80px; padding:6px;">ID</th>
            <th style="width:200px; padding:6px;">Name</th>
            <th style="width:150px; padding:6px;">Status</th>
            <th style="width:150px; padding:6px;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pets as $pet)
            <tr>
                <td style="padding:6px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                    {{ $pet['id'] }}
                </td>
                <td style="padding:6px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                    {{ $pet['name'] ?? 'no name' }}
                </td>
                <td style="padding:6px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                    {{ $pet['status'] ?? '' }}
                </td>
                <td style="padding:6px;">
                    <a href="{{ route('pets.edit', $pet['id']) }}"
                       style="padding:4px 8px; background:#007bff; color:white; text-decoration:none; border-radius:4px; margin-right:5px; font-size:0.9em;">
                       Edit
                    </a>
                    <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit"
                                style="padding:4px 8px; background:#dc3545; color:white; border:none; border-radius:4px; cursor:pointer; font-size:0.9em;">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
