<section>
<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors()?>
<a href="<?= base_url()?>">Volver</a>
<br>
<br>
<br>
<h1><?= esc($error)?></h1>
<br>

<form action="<?= base_url('login')?>" method="post">
    <?= csrf_field() ?>

    <label for="username">Username</label>
    <input type="input" name="username" value="<?= set_value('username')?>">
    <br>
    <label for="password">Password</label>
    <input type="input" name="password" value="<?= set_value('password')?>">
    <br>
    <br>
    <input type="submit" name="submit" value="Login">
</form>
</section>

<section>
    <a href="<?= base_url('users/new');?>">
        Add User
    </a>

</section>