@extends("backend.layout")
@section("title","Üye Düzenleme")
@section("content")


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">724 Chat</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Üye Düzenleme</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Üye Düzenleme</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label class="small mb-1" for="image">Üye Resmi</label>
                                <img src="/images/users/{{$user->image}}" style="width:100px" alt="üye resmi">
                                <input class="form-control" id="image" type="file" name="image">
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="name">Kullanıcı Adı</label>
                                <input class="form-control py-4" id="name" type="text" name="name" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control py-4" id="email" type="email" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="desc">Hakkında</label>
                                <textarea name="description" id="desc" class="form-control">{{ $user->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="borndate">Doğum Tarihi</label>
                                <input class="form-control py-4" id="borndate" type="date" name="borndate" value="{{$user->borndate}}">
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="city">Şehir</label>
                                <input class="form-control py-4" id="city" type="text" name="city" value="{{$user->city}}">
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="password">Şifre</label>
                                <input class="form-control py-4" id="password" type="text" name="password">
                            </div>

                            <div class="form-group">
                                <input class="form-control btn-secondary" type="submit">
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </main>

    </div>

@endsection

@section("css")@endsection
@section("js")@endsection
