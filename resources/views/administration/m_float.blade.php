@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/float_menu/st.action-panel.css')}} ">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/float_menu/st.action-panel.js') }}"></script>
<script>
    $(document).ready(function(){
        $('st-actionContainer').launchBtn( { openDuration: 500, closeDuration: 300 } );
    });
</script>
@endpush



<div class="st-actionContainer right-bottom">
	<div class="st-panel">
		<div class="st-panel-header"><i class="fa fa-bars" aria-hidden="true"></i> Menu</div>
		<div class="card-body p-0 overflow-hidden">
            <a href="{{Route('home')}}" class="btn btn-sm btn-block btn-success"><i class="fas fa-home"></i> HOME</a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item ">
                    <a href="{{route('administration')}}" class="nav-link {{ request()->is('administration') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <b>Dashboard</b>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{route('patient.index')}}" class="nav-link {{ request()->is('patient') ? 'active' : '' }} ">
                        <i class="fas fa-user-injured nav-icon"></i>
                        <b>Patients</b>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{route('patient.create')}}" class="nav-link {{ request()->is('patient/create') ? 'active' : '' }} ">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <b>New Patient</b>
                    </a>
                </li>

            </ul>   
        </div>
	</div>
	<div class="st-btn-container right-bottom">
		<div class="st-button-main"><i class="fa fa-bars" aria-hidden="true"></i></div>
	</div>
</div>
