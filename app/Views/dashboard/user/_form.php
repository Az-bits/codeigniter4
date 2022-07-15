
<div class="form-group">
    <label for="username">Usuario</label>
    <input <?= !$created ? "readonly" : "" ?> class="form-control" type="text" id='username' name="username" value="<?= old('title',$user->username)?>" /><br />
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input <?= !$created ? "readonly" : "" ?> class="form-control" type="text" id='email' name="email" value="<?= old('title',$user->email)?>" /><br />
</div>
<div class="form-group">
    <label for="password">Contraseña</label>
    <input class="form-control" type="password" id='password' name="password" value="" /><br />
</div>
<button class="mt-2 btn btn-success" type="submit"><i class="fa fa-save"></i> <?= $textButton?></button>

