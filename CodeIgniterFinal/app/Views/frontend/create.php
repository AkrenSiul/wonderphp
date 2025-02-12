<main style="background-color: #dddddd">
    <section>
        <h2><?= esc($title) ?></h2>

        <?= session()->getFlashdata('error') ?>
        <?= validation_list_errors() ?>

        <form action="<?= base_url('wonders/create')?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <label for="wonder"><b>Wonder</b></label>
            <br>
            <input type="input" name="wonder" value="<?= set_value('wonder') ?>">
            <br>

            <label for="body"><b>Location</b></label>
            <br>
            <textarea name="location" cols="25" rows="4"><?= set_value('location') ?></textarea>
            <br>

            <br><br>
            <label for="image"><b>Image</b></label>
            <br>
            <input type="file" name="image">
            <br>
            <input type="submit" name="submit" value="Create news item">
        </form>
    </section>
</main>
