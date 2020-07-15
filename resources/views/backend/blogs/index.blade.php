@extends("backend.layout")
@section("title","Blog Listesi")
@section("content")


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">724 Chat</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Blog Yazıları</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Blog Listesi</div>
                    @include("backend.alert")
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Adı</th>
                                    <th>Link</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->id }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td><a href="{{ config("app.url") }}/{{ $blog->sef_link }}">{{ config('app.url') }}/{{ $blog->sef_link }}</a></td>
                                        <td><a href="{{ route("blogs.edit",$blog->id) }}" class="btn btn-secondary">Düzenle</a></td>
                                        <td>
                                            <form method="post" action="{{route("blogs.destroy",$blog->id)}}">
                                                @CSRF
                                                @method("DELETE")
                                            <button type="submit" class="btn btn-danger"> Sil</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Link</th>
                                    <th>Adı</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>

@endsection

@section("css")@endsection
@section("js")@endsection
