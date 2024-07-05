<div>
    @if(session('fail'))
{{--        <div class="bg-red-900 text-center py-4 lg:px-4">--}}
            <div class="p-2 mt-3 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">Oops</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ session('fail') }}</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
            </div>
{{--        </div>--}}
    @endif

    <div class="mt-2 bg-green-500">
        @if(session('success'))
            <span class="text-white text-xs p-2">{{ session('success') }}</span>
        @endif
    </div>

    @include('livewire.includes.create-todo')
    @include('livewire.includes.todo-search')
    <div id="todos-list">
        @foreach($todos as $todo)
            @include('livewire.includes.todo-card')
        @endforeach
        <div class="my-2">
            {{ $todos->links() }}
        </div>
    </div>
</div>
