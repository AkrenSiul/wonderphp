<main style="background-color: #dddddd">
    <section>
        <h4><?= esc($title)?></h4>
    </section>
    <section>
        <h2><?= esc($libro_selected['titulo']) ?></h2>
        <p><?= esc($libro_selected['autor']) ?></p>
        <p><img src="<?= base_url('assets/img/'. $libro_selected['portada']);?>" width="400" height="300">
        </p>
        <br>
        <p><b>Precio:</b> <?= esc($libro_selected['precio'])?>€</p>
        <br>
        <?php
        $session = session();
        if(!empty($session->get('user'))) {
            ?>
            <a href="<?= base_url('admin/deleteBook/'.$libro_selected['id_libro'])?>">
                Delete Book
            </a>
            &nbsp;
            <a href="<?= base_url('admin/updateWonderForm/'.$libro_selected['id_libro'])?>">
                Update Book
            </a>
            <?php
        }
        ?>
        <p>
            <a href="<?= base_url('admin/createBookForm')?>">
                Add new Book
            </a>
        </p>
        <p>
            <a href="<?= base_url('admin/libros')?>">
                Volver a Books
            </a>

        </p>
    </section>
</main>
