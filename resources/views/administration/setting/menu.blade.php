<div class="col-lg-3 col-xl-3 col-md-3 col-sm-12">
    <div class="card">
        <div class="card-header bg-{{$bg}}">
            <h3 class="card-title">
                <i class="fas fa-tools"></i> Setting
            </h3>
        </div>
        
        <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">

                <li class="nav-item active">
                    <a href="{{ route('administration.setting.index') }}" class="nav-link">
                        <i class="fab fa-wpforms"></i>
                        @if(request()->is('administration/setting'))
                        <b>Mode Form Pengisian</b>
                        @else
                        Mode Form Pengisian
                        @endif
                    </a>
                </li>   
                
                

            </ul>
        </div>
        
    </div>
</div>