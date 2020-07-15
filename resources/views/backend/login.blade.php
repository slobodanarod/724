<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Girişi | 724Chat</title>
    <link href="/backend/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Giriş Yap</h3></div>
                            <div class="card-body">
                                @include("backend.alert")
                                <form method="post" action="{{ route("admin.login.post") }}">
                                    @CSRF
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">E-Posta Adresi</label>
                                        <input required class="form-control py-4" id="inputEmailAddress" type="email" name="email" placeholder="E-Posta adresinizi giriniz" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Şifre</label>
                                        <input required class="form-control py-4" id="inputPassword" type="password" name="password" value="JnR390XB" placeholder="Şifrenizi Giriniz" />
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="submit" class="btn btn-primary">Giriş Yap</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center text-center small">
                    <p class="text-center text-muted">Tüm Hakları Saklıdır. &copy; 724 Chat 2020</p>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/backend/js/scripts.js"></script>
</body>
</html>
