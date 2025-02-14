<main style="background-color: #dddddd">
    <section>
        <h2><?= esc($title) ?></h2>

        <?= session()->getFlashdata('error')?>
        <?= validation_list_errors() ?>

        <?php if ($libros !== []): ?>
            <form action="<?= base_url('admin/updateBook/'.$libros['id_libro'])?>" method="post"
                  enctype="multipart/form-data">
                <?= csrf_field() ?>

                <label for="titulo"><b>Title</b></label>
                <br>
                <input type="input" name="titulo" value="<?= esc($libros['titulo']) ?>">
                <br>
                <label for="autor"><b>Author</b></label>
                <br>
                <input type="input" name="autor" value="<?= esc($libros['autor']) ?>">
                <br>
                <br>
                <label for="precio"><b>Price</b></label>
                <br>
                <input type="number" name="precio" value="<?= esc($libros['precio']) ?>">
                <br>

                <br><br>
                <img src="<?= base_url('assets/img/'.$libros['portada'])?>" width="300px">
                <input type="hidden" name="img_libro" value="<?= $libros['portada']?>">
                <br>
                <br>
                <br>
                <label for="image">New Title Page</label>
                <input type="file" name="image">
                <br>
                <br>
                <input type="submit" name="submit" value="Updated Wonder">
            </form>

        <?php endif ?>
    </section>

</main>
