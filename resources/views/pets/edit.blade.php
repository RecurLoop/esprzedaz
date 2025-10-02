<h1 style="margin-bottom:15px;">Edit Pet</h1>

<form method="POST" action="{{ route('pets.update', $pet['id']) }}"
      style="max-width:400px; margin:auto; display:flex; flex-direction:column; gap:10px;">
    @csrf
    @method('PUT')

    <label>
        Name:
        <input name="name" value="{{ $pet['name'] ?? '' }}" required
               style="width:100%; padding:6px; border:1px solid #ccc; border-radius:4px;">
    </label>

    <label>
        Status:
        <select name="status" required
                style="width:100%; padding:6px; border:1px solid #ccc; border-radius:4px;">
            <option value="available" {{ ($pet['status'] ?? '') === 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending"   {{ ($pet['status'] ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold"      {{ ($pet['status'] ?? '') === 'sold' ? 'selected' : '' }}>Sold</option>
        </select>
    </label>

    <button type="submit"
            style="padding:8px 12px; background:#007bff; color:white; border:none; border-radius:4px; cursor:pointer; font-weight:bold;">
        Update
    </button>
</form>
