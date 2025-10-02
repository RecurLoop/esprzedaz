<h1 style="margin-bottom:15px;">Add Pet</h1>

<form method="POST" action="{{ route('pets.store') }}"
      style="max-width:400px; margin:auto; display:flex; flex-direction:column; gap:10px;">
    @csrf

    <label>
        ID:
        <input name="id" placeholder="Enter ID" required
               style="width:100%; padding:6px; border:1px solid #ccc; border-radius:4px;">
    </label>

    <label>
        Name:
        <input name="name" placeholder="Enter name" required
               style="width:100%; padding:6px; border:1px solid #ccc; border-radius:4px;">
    </label>

    <label>
        Status:
        <select name="status" required
                style="width:100%; padding:6px; border:1px solid #ccc; border-radius:4px;">
            <option value="available">Available</option>
            <option value="pending">Pending</option>
            <option value="sold">Sold</option>
        </select>
    </label>

    <button type="submit"
            style="padding:8px 12px; background:#28a745; color:white; border:none; border-radius:4px; cursor:pointer; font-weight:bold;">
        Save
    </button>
</form>
