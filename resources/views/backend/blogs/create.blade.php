@extends("backend.layout")
@section("title","Blog Düzenleme")
@section("content")

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">724 Chat</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Blog Düzenleme</li>
                </ol>
                @include("backend.alert")
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Blog Düzenleme</div>
                    <div class="card-body">
                        <form action="{{route("blogs.store")}}" method="post" enctype="multipart/form-data">
                            @CSRF
                            <div class="form-group">
                                <label class="small mb-1" for="name">Başlık</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="name">Başlık</label>
                                <input class="form-control py-4" id="name" type="text" name="title" >
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="keywords">Keywords</label>
                                <input class="form-control py-4" id="keywords" type="text" name="keywords" >
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="description">Description</label>
                                <input class="form-control py-4" id="description" type="text" name="description" >
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="content">İçerik</label>
                                <textarea name="content" id="content" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <input class="form-control btn-success" type="submit" value="Ekle">
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
