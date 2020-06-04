@extends("backend.layout")
@section("title","Hakkında Yazısı Olan Üyeler Listesi")
@section("content")


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">724 Chat</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Tehlikeli Üyeler</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Tehlikeli Üyeler Listesi</div>
                    <div class="btn-group float-right m-1">
                        <a href="/admin/users/" class="btn btn-primary">Tüm Üyeler</a>
                        <a href="/admin/users/with/abouts" class="btn btn-primary">Hakkında Yazısı Olanlar</a>
                        <a href="/admin/users/with/img" class="btn btn-primary">Resimli Üyeler</a>
                        <a href="/admin/users/with/ban" class="btn btn-primary">Yasaklı Üyeler</a>
                        <a href="/admin/users/with/danger" class="btn btn-primary">Tehlikeli Üyeler</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Resim</th>
                                    <th>Adı</th>
                                    <th>E-Posta Adresi</th>
                                    <th>Kayıt Tarihi</th>
                                    <th>Hakkında</th>
                                    <th>Yasak</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Resim</th>
                                    <th>Adı</th>
                                    <th>E-Posta Adresi</th>
                                    <th>Kayıt Tarihi</th>
                                    <th>Hakkında</th>
                                    <th>Yasak</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </tfoot>
                                <tbody>


                                @foreach($users as $user)

                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td><img src="/images/users/{{$user->image}}" style="width:75px;"></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->description }}</td>
                                        @if($user->status === 1 )
                                            <td><a href="{{ route("admin.users.banned",$user->id) }}">Yasakla</a></td>
                                        @else
                                            <td><a href="{{ route("admin.users.banned",$user->id) }}">Yasak Kaldır</a>
                                            </td>
                                        @endif
                                        <td><a href="{{ route("users.edit",$user->id) }}">Düzenle</a></td>
                                        <td><a href="{{ route("users.destroy",$user->id) }}">Sil</a></td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>

@endsection

@section("css")@endsection
@section("js")@endsection
