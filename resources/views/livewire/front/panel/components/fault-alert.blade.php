<div>


   <div class="text-center">

       @foreach($building_list as $building)
           <button wire:click="show({{$building->id}})" class="btn btn-outline-info">
              {{ $building->builder_name }}
           </button>
       @endforeach

       @if($elevator_list)
           <li>
               @foreach($elevator_list as $elevator)
                   {{ $elevator->phone  }}    <br/>
               @endforeach
           </li>

       @endif



   </div>


</div>
