@extends('layouts.app')
@push('header_menus')
<li class="nav-item d-none d-sm-inline-block">
    <a class="nav-link active">
        <b>{{$title}}</b>
    </a>
</li>
@endpush
@section('content')

<div class="container">
    <div class="row ">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-{{\App\Models\Config::get()['navbar_variants']}} ">
                    <h3 class="card-title">
                        <b>{{$title}}</b>
                    </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">

                            @if (Auth::user()->hasRole('admin') || Auth::user()->hasAnyPermission(['post_test.create', 'post_test.edit', 'post_test.delete']) )
                            <span class="input-group-append ">
                                <a href="{{Route('post_test.create')}}" class="btn  btn-info"><i
                                        class="fas fa-plus-circle"></i> Post Baru</a>
                            </span>
                            @endif

                            <span class="input-group-append ">
                                {{ $posts->links() }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                            <th>Menu</th>
                        </thead>
                        <tbody>
                        
                            @foreach ($posts as $i=>$item)
                            <tr>
                                <td>{{ $i + $posts->firstItem() }}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->author->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td class="btn-group">
                                    @if (Auth::user()->hasRole('admin') || Auth::user()->hasAnyPermission(['post_test.show','post_test.create', 'post_test.edit', 'post_test.delete']))
                                    <a href="{{Route('post_test.show', $item->slug)}}" class="btn btn-sm btn-success"><i
                                            class="far fa-eye"></i></a>
                                    @endif
                                    
                                    @if (Auth::user()->hasRole('admin') || Auth::user()->hasAnyPermission(['post_test.create', 'post_test.edit', 'post_test.delete']))
                                    <a href="{{Route('post_test.edit', $item->id)}}" class="btn btn-sm btn-warning"><i
                                            class="fas fa-edit"></i></a>
                                    @endif
                                    
                                    @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('post_test.delete'))
                                    <form action="{{Route('post_test.destroy', $item->id)}}" method="post"
                                        class="delete-submit-form">
                                        @csrf
                                        @method('DELETE')
                                        <a onclick="return false" class="btn btn-sm btn-danger delete-btn"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
