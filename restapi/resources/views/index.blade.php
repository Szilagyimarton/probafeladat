<header><a href="/create">Add new </a></header>

@foreach ($employees as $employee)
    <span>{{ session('success')}} </span>
        
    <x-employee :employee="$employee"/>
@endforeach