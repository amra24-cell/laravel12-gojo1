<h1>My Multiple Gallery</h1>

@foreach($images as $img)
    <img src="{{ $img }}" width="300">
@endforeach