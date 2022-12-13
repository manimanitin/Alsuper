<?php
if (estaLogueado()) {
    include_once APPROOT . '/views/includes/header.inc.php';
    include_once APPROOT . '/views/includes/footer.inc.php';

?>


<?php } else { ?>
    <?php include_once APPROOT . '/views/includes/alt_header.inc.php'; ?>
    <form action="<?=
                    URLROOT;
                    ?>/usuarios/login" method="POST">
        <!-- ========== Start Section ======== poner verificacion== -->
        <div class="mb-3">
            <label for="username" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" name="usuario-username" id="username" aria-describedby="helpId" placeholder="123@g.com" value="<?php echo (isset($username)) ? $username : ''; ?>">
            <small id="helpId" class="form-text text-muted">Ingrese su username</small>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="usuario-password" id="password" aria-describedby="helpId" placeholder="" value="<?php echo (isset($password)) ? $password : ''; ?>">
            <small id="helpId" class="form-text text-muted">Ingrese su password</small>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>

    </form>
    <?php include_once APPROOT . '/views/includes/footer.inc.php'; ?>

<?php } ?>