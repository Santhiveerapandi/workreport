<div>
    <form wire:submit="addTask">
        <input type="date" wire:model="form.work_report_date"> 
        @error('form.work_date') <span>{{ $message }}</span>
        @enderror 
        <select wire:model="form.project_id" name="project_id">
            @foreach($projects as $p)
            <option value="{{$p['id']}}">{{$p['name']}}</option>
            @endforeach
        </select>

        <input type="text" wire:model="form.duration_input" placeholder="e.g. 7:30"> 
        <button type="submit">Add Task</button> 
    </form> 
    
    <table> 
        @if(isset($tasks)!==NULL)
        @foreach($tasks as $index => $task) 
        <tr> <td>{{ $task['description'] }}</td> <td>{{ $task['duration_minutes'] / 60 }} hours</td>
             <td><button wire:click="removeTask({{ $index }})">Delete</button></td> </tr> 
        @endforeach 
        @endif
    </table> 
    <button wire:click="saveAll">Submit All</button>

</div>