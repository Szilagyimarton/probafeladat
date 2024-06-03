@props(['employee'])

<div class="employee">
  <h3>{{$employee->name}}</h3>
  <a href="/people/{{$employee->email}}"><button>Show</button></a>
</div>