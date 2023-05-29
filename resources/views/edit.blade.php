<form method="POST" action="{{ isset($data->id) ? route('data.save', $data->id) : route('data.save') }}" enctype="multipart/form-data">
    @csrf
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="{{ $data->title ?? old('title') }}" required>
    <br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required>{{ $data->description ?? old('description') }}</textarea>
    <br>
    <label for="image">Image:</label>
    <input type="file" id="image" name="image">
    <br>
    @if(isset($data->image))
        <img src="{{ asset('storage/' . $data->image) }}" alt="Image">
    @endif
    <br>
    <button type="submit">Save</button>
</form>


