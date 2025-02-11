<section>
    <h2><?= esc($title) ?></h2>

    <?= session()->getFlashdata('error') ?>
    <?= validation_list_errors() ?>

    <form action="<?= base_url('wonders/create')?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="wonder">Wonder</label>
        <input type="input" name="wonder" value="<?= set_value('wonder') ?>">
        <br>

        <label for="body">Location</label>
        <textarea name="location" cols="45" rows="4"><?= set_value('location') ?></textarea>
        <br>

        <br><br>
        <label for="image">Wonder</label>
        <input type="input" name="image" value="<?= set_value('image') ?>">
        <br>
        <br>
        <br>
        <input type="submit" name="submit" value="Create news item">
    </form>
</section>