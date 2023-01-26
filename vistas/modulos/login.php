    <div class="login-box">
        <div class="login-logo">
            <a href="../index2.html"><b>EARPFIM</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">inicio de sesion</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Ingrese usuario" name="ingUsuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="ingPassword">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>

                    <?php
                    $login = new ControladorUsuarios();
                    // $login->ctrIngresar();
                    $login->ctrIngreso();
                    ?>

                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>