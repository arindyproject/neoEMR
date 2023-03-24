<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
    <div class="card">
        <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}} ">
            <h3 class="card-title">
                <i class="fas fa-table"></i>
                <b>Table {{$title}}</b>
            </h3>
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <span class="input-group-append ">
                        <a href="{{Route($url_index)}}" class="btn  btn-outline-danger"><i class="fas fa-table"></i> ALL Data {{$title}}</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-sm table-striped">
                <thead>
                    <th>NO</th>
                    <th>Kode</th>
                    <th>Kode Kota</th>
                    <th>Provinsi</th>
                    <th>Kota / Kabupaten</th>
                    <th>Kecamatan</th>
                    <th>Desa / Kelurahan</th>
                    <th>Author</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>

                    <th>Menu</th>
                </thead>
                <tbody>
                    @foreach ($data as $i=>$item)
                        <tr>
                            <td>{{$i + $data->firstItem() }}</td>
                            <td>{{$item->kode}}</td>
                            <td>{{$item->kode_kota}}</td>
                            <td>
                                @if ($item->att_alamat_provinsis_id != '')
                                    <a href="{{Route('attributes.alamat.provinsi.index')}}?id={{$item->provinsi->id}}"><i class="fas fa-arrow-circle-left"></i> {{$item->provinsi->nama}}</a>
                                @endif
                            </td>
                            <td><b>{{$item->nama}}</b></td>
                            <td>
                                <a href="{{Route('attributes.alamat.kecamatan.index')}}?att_alamat_kotas_id={{$item->id}}" ><b>{{$item->kecamatan->count()}}</b> <i class="fas fa-arrow-circle-right"></i></a>
                            </td>
                            <td>
                                <a href="{{Route('attributes.alamat.kelurahan.index')}}?att_alamat_kotas_id={{$item->id}}" ><b>{{$item->kelurahan->count()}}</b> <i class="fas fa-arrow-circle-right"></i></a>
                            </td>
                            <td>{{$item->user_id != '' ? $item->author->name : ''}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td class="btn-group">
                                <a href="{{Route($url_edit, $item->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                <form action="{{Route($url_delete, $item->id)}}" method="post"
                                    class="delete-submit-form">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger delete-btnd"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->appends(['att_alamat_provinsis_id'=>request('att_alamat_provinsis_id')])->links() }}
        </div>
    </div>
</div>