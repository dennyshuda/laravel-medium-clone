@props(['user', 'size' => 'w-12 h-12'])

@if ($user->image)
    <img class="{{ $size }} rounded-full object-cover" src="{{ Storage::url($user->image) }}"
        alt="{{ $user->name }}">
@else
    <img class="{{ $size }} rounded-full object-cover"
        src="https://tamilnaducouncil.ac.in/wp-content/uploads/2020/04/dummy-avatar.jpg" alt="Dummy Avatar">
@endif
