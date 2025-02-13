<main style="background-color: #dddddd">
    <section>
        <h2><?= esc($title) ?></h2>

        <?= session()->getFlashdata('error') ?>
        <?= validation_list_errors() ?>

        <form action="<?= base_url('admin/createWonder')?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <label for="wonder">Wonder</label>
            <input type="input" name="wonder" value="<?= set_value('wonder') ?>">
            <br>
            <label for="location">Location</label>
            <input type="input" name="location" value="<?= set_value('location') ?>">
            <br>
            <label for="image">Image</label>
            <br>
            <br>
            <input type="file" name="image">
            <br>
            <br>
            <input type="submit" name="submit" value="Create Wonder">
        </form>
    </section>
</main>
