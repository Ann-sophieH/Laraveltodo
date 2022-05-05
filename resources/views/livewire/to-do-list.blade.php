<div class="container-fluid my-5 row col-10 mx-auto card shadow">
    @if(session('todo_mess'))
        <div class="alert alert-warning  alert-dismissible text-white my-3" role="alert">
            <i class="bi  bi-exclamation-triangle-fill ps-3">
            </i>
            <span class="text-sm text-muted ps-4">{{session('todo_mess')}} </span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close" control-id="ControlID-6">
                <span aria-hidden="true">×</span>
            </button>
        </div>

    @endif
    <h1 class="my-3 text-center">To do list</h1>
    <p class="text-center text-muted mb-3"> you have to <a href="{{route('login')}}" class="text-black "><b>login</b></a> to add tasks </p>
    <div class="row">
        <div class="input-group">
            <input type="text" required @if(Auth::user()) wire:keydown.enter="addTask({{Auth::user()->id}})"  @endif class="form-control py-2 shadow-none @error('taskTitle') is-invalid @enderror"
                   placeholder="What needs to be done?" @if(!Auth::user()) readonly @endif wire:model="taskTitle" >
            <button class="btn btn-outline-secondary " @if(Auth::user())  wire:click="addTask({{Auth::user()->id}})" @endif> Add</button>
            @error('taskTitle')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="row">
        <ol class="list-group my-3 col-11  mx-auto">

            @foreach($tasks as $task)
                <li class="list-group-item d-flex justify-between">
                    <span class="col-5 {{($task->deleted_at != null) ? 'text-decoration-line-through text-danger' : ' '}}">{{$task->title}}</span>

                    <div class="col-3 justify-between">
                        <span class="">  {{$task->user->name}} </span>
                        <button class="btn shadow-none" wire:click="deleteTask({{$task}})" @if(!Auth::user() ) disabled @endif><i class="bi bi-x-circle text-danger"></i></button>

                    </div>

                </li>
            @endforeach

        </ol>
        @if(Auth::user())
        <button class="btn btn-outline-danger w-25 mx-auto my-5" wire:click="deleteAllTasks()"> DELETE ALL TASKS</button>
        @endif
    </div>



</div>
