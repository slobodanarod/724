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
                        <form action="{{route("blogs.update",$blog->id)}}" method="post" enctype="multipart/form-data">
                            @CSRF
                            @method("PUT")
                            <div class="form-group">
                                <label class="small mb-1" for="name">Eski Görsel</label>
                             <img src="/images/blogs/{{ $blog->image }}" width="150px;">
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="name">Görsel</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="name">Başlık</label>
                                <input class="form-control py-4" id="name" type="text" name="title" value="{{ $blog->title }}">
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="keywords">Keywords</label>
                                <input class="form-control py-4" id="keywords" type="text" name="keywords" value="{{ $blog->keywords }}">
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="description">Description</label>
                                <input class="form-control py-4" id="description" type="text" name="description" value="{{ $blog->description }}">
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="content">İçerik</label>
                                <textarea name="content" id="content" class="form-control">{{ $blog->content }}</textarea>
                            </div>

                            <div class="form-group">
                                <input class="form-control btn-success" type="submit" value="Düzenle">
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
