@extends("backend.layout")
@section("title","Sayfalar Listesi")
@section("content")


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">724 Chat</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Sayfalar</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Sayfalar Listesi</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Adı</th>
                                    <th>Düzenle</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>

                                    <th>#</th>
                                    <th>Adı</th>
                                    <th>Düzenle</th>

                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($pages as $page)
                                    <tr>
                                        <td>{{ $page->id }}</td>
                                        <td>{{ $page->name }}</td>
                                        <td><a href="{{ route("pages.edit",$page->id) }}">Düzenle</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
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
