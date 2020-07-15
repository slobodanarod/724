@extends("backend.layout")
@section("title","Sayfa Düzenleme")
@section("content")


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">724 Chat</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Sayfa Düzenleme</li>
                </ol>
                @include("backend.alert")
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Sayfa Düzenleme</div>
                    <div class="card-body">
                        <form action="{{route("pages.update",$page->id)}}" method="post">
                            @CSRF
                            @method("PUT")
                            <div class="form-group">
                                <label class="small mb-1" for="name">Başlık</label>
                                <input class="form-control py-4" id="name" type="text" name="title"
                                       value="{{$page->name}}">
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="name">Başlık İngilizce</label>
                                <input class="form-control py-4" id="name" type="text" name="title_en"
                                       value="{{$page->name_en}}">
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="desc">Hakkında Türkçe</label>
                                <textarea name="content" id="desc" class="form-control">{{ $page->content }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="desc">Hakkında İngilizce</label>
                                <textarea name="content_en" id="desc"
                                          class="form-control">{{ $page->content_en }}</textarea>
                            </div>

                            <div class="form-group">
                                <input class="form-control btn-secondary" type="submit" value="Düzenle">
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
