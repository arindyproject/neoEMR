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

                <li class="nav-item active">
                    <a href="{{ route('administration.setting.print.pasien.profil') }}" class="nav-link">
                        <i class="fas fa-id-badge"></i>
                        @if(request()->is('administration/setting/print/pasien/profil'))
                        <b>Template Profil Pasien</b>
                        @else
                        Template Profil Pasien
                        @endif
                    </a>
                </li>  

                <li class="nav-item active">
                    <a href="{{ route('administration.setting.print.pasien.card') }}" class="nav-link">
                        <i class="far fa-id-card"></i>
                        @if(request()->is('administration/setting/print/pasien/card'))
                        <b>Template card Pasien</b>
                        @else
                        Template card Pasien
                        @endif
                    </a>
                </li>  

                <li class="nav-item active">
                    <a href="{{ route('administration.setting.print.pasien.label') }}" class="nav-link">
                        <i class="fas fa-tag"></i>
                        @if(request()->is('administration/setting/print/pasien/label'))
                        <b>Template label Pasien</b>
                        @else
                        Template label Pasien
                        @endif
                    </a>
                </li>  


                <li class="nav-item active">
                    <a href="{{ route('administration.setting.payment') }}" class="nav-link">
                        <i class="fas fa-money-bill-wave"></i>
                        @if(request()->is('administration/setting/payment'))
                        <b>Payment</b>
                        @else
                        Payment
                        @endif
                    </a>
                </li>  

            </ul>
        </div>
        
    </div>
</div>