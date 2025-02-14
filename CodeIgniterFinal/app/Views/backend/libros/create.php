<main style="background-color: #dddddd">
    <section>
        <h2><?= esc($title) ?></h2>

        <?= session()->getFlashdata('error') ?>
        <?= validation_list_errors() ?>

        <form action="<?= base_url('admin/createBook')?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <label for="titulo">Title</label>
            <input type="input" name="titulo" value="<?= set_value('titulo') ?>">
            <br>
            <label for="autor">Author</label>
            <input type="input" name="autor" value="<?= set_value('autor') ?>">
            <br>
            <label for="precio">Price</label>
            <input type="number" name="precio" value="<?= set_value('precio') ?>">
            <br>
            <label for="image">Image</label>
            <br>
            <br>
            <input type="file" name="image">
            <br>
            <br>

            <input type="submit" name="submit" value="Create Book">
        </form>
    </section>
</main>
