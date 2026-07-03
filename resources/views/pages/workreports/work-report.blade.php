<x-layouts::app :title="__('Employee|WorkReport')">
<section class="w-full">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Employee Workreport') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage your Daily Works Here') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <div class="relative mb-6 w-full">
        <div class="bg-gray-700">{{ __('Add WorkReport') }}</div>
    </div>
    <div class="mb-10">
        <form method='post' action="{{ route('workreport.addTask') }}" wire:submit="addTask">
        @csrf
            <div class="mb-5">
                <label for="work_report_date" class="block mb-2 text-sm font-medium text-red-700">
                    Work Date</label>
                <input type="date" name="work_report_date" wire:model="form.work_report_date"
            class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"> 
                @error('form.work_report_date') <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="project_id" class="block mb-2 text-sm font-medium text-red-700">
                    Project</label> 
            <select name="project_id" wire:model="form.project_id"
            class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                <option value="">{{ __('Select Any One Project') }}</option>
                @foreach($projects as $p)
                <option value="{{$p['id']}}">{{$p['name']}}</option>
                @endforeach
            </select>
            @error('form.project_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            </div>

            <div class="mb-5">
                <label for="project_id" class="block mb-2 text-sm font-medium text-red-700">
                Duration</label> 
            
                <input type="text" name="duration_input" wire:model="form.duration_input" 
            placeholder="e.g. 7:30" class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
            @error('form.duration_input') <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            </div>
            <div class="mb-5">
            <button type="submit" 
            class="
            relative items-center font-medium justify-center gap-2 whitespace-nowrap disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none justify-center h-10 text-sm rounded-lg ps-4 pe-4 inline-flex  bg-[var(--color-accent)] hover:bg-[color-mix(in_oklab,_var(--color-accent),_transparent_10%)] text-[var(--color-accent-foreground)] border border-black/10 dark:border-0 shadow-[inset_0px_1px_--theme(--color-white/.2)] [[data-flux-button-group]_&]:border-e-0 [:is([data-flux-button-group]>&:last-child,_[data-flux-button-group]_:last-child>&)]:border-e-[1px] dark:[:is([data-flux-button-group]>&:last-child,_[data-flux-button-group]_:last-child>&)]:border-e-0 dark:[:is([data-flux-button-group]>&:last-child,_[data-flux-button-group]_:last-child>&)]:border-s-[1px] [:is([data-flux-button-group]>&:not(:first-child),_[data-flux-button-group]_:not(:first-child)>&)]:border-s-[color-mix(in_srgb,var(--color-accent-foreground),transparent_85%)] *:transition-opacity [&[disabled]>:not([data-flux-loading-indicator])]:opacity-0 [&[disabled]>[data-flux-loading-indicator]]:opacity-100 [&[disabled]]:pointer-events-none  w-full
            ">Add Task</button> 
            </div>
        </form> 
    </div>
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500"> 

            @if(isset($tasks)!==NULL)
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3"> {{ __('Report Date') }} </th>
                <th scope="col" class="px-6 py-3"> {{ __('Project Name') }} </th>
                <th scope="col" class="px-6 py-3"> {{ __('Duration Hours') }} </th>
                <th scope="col" class="px-6 py-3 text-right "> {{ __('Actions') }} </th>
            </tr>
            </thead>
            @foreach($tasks as $index => $task) 
            <tr class="bg-white border-b hover:bg-gray-50"> 
                <td class="px-6 py-4">
                    {{ $task['work_report_date'] }}</td> 
                <td class="px-6 py-4">
                    {{ $task['project']["name"] }}</td> 
                <td class="px-6 py-4">
                    {{ $task['duration_minutes'] / 60 }} hours</td>
                <td class="px-6 py-4">
                    <button class="font-medium text-blue-600 hover:underline" wire:click="removeTask({{ $index }})">Delete</button></td> 
            </tr> 
            @endforeach 
            @endif
        </table> 
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
    <!-- <button wire:click="saveAll">Submit All</button> -->
    
</section>
</x-layouts::app>