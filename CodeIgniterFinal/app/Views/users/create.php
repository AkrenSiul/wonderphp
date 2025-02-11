<section>
    <h2><?= esc($title) ?></h2>

    <?= session()->getFlashdata('error') ?>
    <?= validation_list_errors() ?>

    <form action="<?= base_url('admin/create')?>" method="post">
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input type="input" name="username" value="<?= set_value('username') ?>">
        <br>
        <label for="password">Password</label>
        <input type="input" name="password" value="<?= set_value('password') ?>">
        <br>
        <label for="email">Email</label>
        <input type="input" name="email" value="<?= set_value('email') ?>">
        <br>
        <label for="rol">Rol</label>
        <input type="number" name="rol" value="<?= set_value('rol') ?>">
        <br>

        <input type="submit" name="submit" value="Create User">
    </form>
</section>