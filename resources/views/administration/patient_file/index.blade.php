@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/photoviewer/photoviewer.css')}} ">

@endpush

@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>
@include('administration.menus')
@endpush

@section('content')

<div class="row">
    @include('administration.patient.show_left')

    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12">
        <div class="card" id="data-patient">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    @include('administration.patient.show_menu')
                </ul>
            </div>
            <div class="card-body table-responsive p-0">
                <a href="{{Route('file.patient.create', $data->id)}}" class="btn btn-info"><i
                        class="fas fa-upload"></i> Upload File Baru</a>
                <table class="table table-sm">
                    <thead>
                        <th>NO</th>
                        <th>title</th>
                        <th>file</th>
                        <th>deskripsi</th>
                        <th>author</th>
                        <th>edithor</th>
                        <th>Menu</th>
                    </thead>
                    <tbody>
                        @foreach ($files as $i=>$item)
                        <tr>
                            <td>{{ $i + $files->firstItem() }}</td>
                            <td>{{$item->title}}</td>
                            <td>
                                @if (strtolower(pathinfo($item->file)['extension']) == 'pdf')
                                <button id="" data-title="{{$item->title}}" data-file="{{$item->file}}" class="btn btn-sm btn-outline-info btn-pdf"><i class="fas fa-file-pdf"></i> Lihat</button>
                                @else
                                @if (strtolower(pathinfo($item->file)['extension']) == 'png' ||
                                strtolower(pathinfo($item->file)['extension']) == 'jpg' ||
                                strtolower(pathinfo($item->file)['extension']) == 'jpeg')
                                <a class="btn btn-sm btn-outline-info btn-viewr" href="/files/patient/{{$item->file}}"
                                   data-title="{{$item->title}}" ><i class="fas fa-images"></i> Lihat</a>
                                @else
                                <a class="btn btn-sm btn-outline-info " href="/files/patient/{{$item->file}}"><i
                                        class="fas fa-file-download"></i> Download</a>
                                @endif
                                @endif
                            </td>
                            <td>{{$item->ket}}</td>
                            <td>{{$item->author_id != '' ? $item->author->name : '-'}} <br> {{$item->created_at}}</td>
                            <td>{{$item->edithor_id != '' ? $item->edithor->name : '-'}} <br>
                                {{$item->updated_at != $item->created_at ? $item->updated_at : '-'}}</td>
                            <td class="btn-group">
                                <a href="{{Route('file.patient.edit', [$data->id,$item->slug])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{Route('file.patient.delete', $item->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" type="submit"  class="btn btn-sm btn-danger"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div  class="modal fade bd-example-modal-lg" tabindex="-1" id="modal-pdf" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" >
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><b id="title-pdf"></b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" >
            <div style="height: 900px;" id="pdf-viewer"></div>
        </div>
      </div>
    </div>
</div>



@push('scripts')
<script src="{{ asset('assets/plugins/photoviewer/photoviewer.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfobject/pdfobject.js') }}"></script>

<script>
    $('.btn-pdf').click(function(){
        var file = $(this).data("file");
        var title = $(this).data("title");

        $('#title-pdf').html(title);
        PDFObject.embed("/files/patient/" + file, "#pdf-viewer");
        $('#modal-pdf').modal('show'); 
    });
    // initialize manually with a list of links
    $('.btn-viewr').click(function (e) {
        e.preventDefault();
        var items = [{
                src: $(this).attr('href'),
                title: $(this).attr('data-title')
            }],
            options = {
                index: $(this).index(),
                positionFixed: false
            };
        new PhotoViewer(items, options);
    });

</script>
@endpush

@include('administration.m_float')
@endsection
