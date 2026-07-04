<x-layouts::app :title="__('Employee | WorkReport')">
<section class="w-full">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Employee Workreport') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage your Daily Works Here') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <div class="relative mb-6 w-full">
        <div class="bg-gray-700">{{ __('View WorkReport') }}</div>
    </div>
    <div class="mb-10">
            <div class="mb-5">
                <label for="project_id" class="block mb-2 text-sm font-medium text-red-700">
                {{__('Employee Name')}}: {{ $workreport['employee']['name'] }} </label> 
            
                
            </div>
            
            <div class="mb-5">
                <label for="project_id" class="block mb-2 text-sm font-medium text-red-700">
                {{__('Project')}}: {{ $workreport['project']['name'] }} </label> 
            
                
            </div>

            <div class="mb-5">
                <label for="work_report_date" class="block mb-2 text-sm font-medium text-red-700">
                    {{__('Report Date')}}: {{$workreport['work_report_date']}}</label>
                
            </div>
            <div class="mb-5">
                <label for="project_id" class="block mb-2 text-sm font-medium text-red-700">
                    {{__('Project')}}: {{ $workreport['project']['name'] }}</label> 
            </div>
            <div class="mb-5">
                <label for="task_description" class="block mb-2 text-sm font-medium text-red-700">
                    {{__('Task Description')}}: {{ $workreport['task_description']}}</label>
                
            </div>
            <div class="mb-5">
                <label for="project_id" class="block mb-2 text-sm font-medium text-red-700">
                {{__('Duration')}}: {{ $workreport['duration_minutes'] }} Minutes</label> 
            
                
            </div>
    </div>
    
    
</section>
</x-layouts::app>