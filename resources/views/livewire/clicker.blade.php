<div>
    @if(session('success'))
        <span class="px-3 py-3 bg-green-600 text-white rounded mt-4">{{ session('success') }}</span>
    @endif
    <form class="p-5" wire:submit="creatNewUser">
        <input class="block rounded border border-gray-100 px-3 py-1 mt-2" wire:model="name" type="text" placeholder="name">
        @error('name')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
        <input class="block rounded border border-gray-100 px-3 py-1 mt-2" wire:model="email" type="email" placeholder="email" autocomplete="off">
        @error('email')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
        <input class="block rounded border border-gray-100 px-3 py-1 mt-2" wire:model="password" type="password" placeholder="password" autocomplete="off">
        @error('password')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
{{--        <button wire:click.prevent="creatNewUser">Create</button>--}}
        <button class="block rounded bg-gray-400 px-3 py-1 text-white mt-2">Create</button>
    </form>

    <hr>

    @foreach($users as $user)
        <h3>{{ $user->name }}</h3>
    @endforeach

    {{ $users->links() }}
</div>
