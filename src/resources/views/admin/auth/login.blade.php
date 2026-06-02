<!doctype html>

<html lang="pt-BR">

<head>
    @include('admin.partials.head')
</head>


<body class="login-page bg-body-secondary">
    <div class="login-box">

        <div class="login-logo">
            <a href=""><b>TheGusta</b> Dashboard</a>
        </div>

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Acesso ao painel Administrativo - TheGUSTA!</p>
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-warning" role="alert">
                        Vefique os dados (Email / Senha)
                    </div>
                @endif

                <form action="{{ route('admin.login.autenticar') }}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" name="email_usuario" class="form-control" placeholder="Email" />
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="senha_usuario" class="form-control" placeholder="Password" />
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
            <!-- /.login-card-body -->
        </div>

    </div>

    @include('admin.partials.script')


</body>

</html>