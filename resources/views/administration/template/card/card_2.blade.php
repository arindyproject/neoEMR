<html>
<head>
  <style>
    @page { size: 8.56cm 5.398cm landscape; }
    html{
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 10px;
    }

    .table_t {
        margin: auto;
        border-spacing : 0.5pt;
    }

    .table_t tr td {
        text-align: center;
    }

    .table_p tr td {
        font-size: 12px;
        vertical-align: top;
    }


  </style>
</head>
<body>


    <table class="table_t">
        <tr>
            <td><b style="font-size: 12px;">{{$profil_name}}</b></td>
        </tr>
        <tr>
            <td><i style="font-size: 12px;">{{$profil_alamat}}</i></td>
        </tr>
        <tr>
            <td style="font-size: 12px">{{$profil_email}} -- {{$profil_no_tlp}}</td>
        </tr>
    </table>

    <hr>
    <table class="table_p">
        <tr valign="top">
            <td style="width: 60px">No RM</td>
            <td>:</td>
            <td><b>{{$data->no_rm}}</b></td>
        </tr>
        <tr valign="top">
            <td>Nama</td>
            <td>:</td>
            <td>{{$data->full_name}}</td>
        </tr>
        <tr valign="top">
            <td>Tgl Lahir</td>
            <td>:</td>
            <td>{{$data->place_of_birth}}, {{$data->birthDate != '' ? Carbon\Carbon::parse($data->birthDate)->format('d-m-Y') : '--' }}</td>
        </tr>
        <tr>
            <td colspan="3" >{!! DNS1D::getBarcodeHTML($data->no_rm, 'CODABAR') !!}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center"><b>Dibawa saat berobat</b></td>
        </tr>
    </table>
    
</body>
</html>