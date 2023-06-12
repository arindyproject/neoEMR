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
                <li class="nav-item  d-sm-inline-block">
                    <a href="{{route('attributes.kepegawaian.profesi.index')}}" class="nav-link {{ request()->is('attributes/kepegawaian/profesi') ? 'active' : '' }} ">
                        <i class="fas fa-user-tie"></i>
                        <b>Profesi</b>
                    </a>
                </li>
            </ul>
            
        </div>
        
	</div>
	<div class="st-btn-container right-bottom">
		<div class="st-button-main"><i class="fa fa-bars" aria-hidden="true"></i></div>
	</div>
</div>
