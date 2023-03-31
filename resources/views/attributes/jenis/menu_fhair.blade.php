
<li class="nav-item  d-sm-inline-block ">
    <a href="{{route('attributes.fhair_hl7.setting')}}" class="nav-link {{ request()->is('attributes/fhair_hl7/setting') ? 'active' : '' }}">
        <i class="fas fa-sliders-h nav-icon"></i>
        <b>SETTING</b>
    </a>
</li>


@foreach (\App\Models\Config::get_fhair_cs() as $i=>$item)
<li class="nav-item  d-sm-inline-block ">
    <a href="{{route('attributes.fhair_hl7.CodeSystem' , $i)}}" class="nav-link {{ request()->is('attributes/fhair_hl7/CodeSystem/'. $i) ? 'active' : '' }}">
        <i class="fas fa-code nav-icon"></i>
        <b>CS : {{$i}}</b>
    </a>
</li>
@endforeach


