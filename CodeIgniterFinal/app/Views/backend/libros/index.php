<main style="background-color: #dddddd">

    <section>

        <?php if ($libros !== []): ?>

            <?php foreach ($libros as $libro): ?>
                <div class="main">
                    <h4><?= esc($libro['titulo']) ?></h4>
                </div>

                <img src="<?= base_url('assets/img/'.$libro['portada']) ?>"
                     width="300" height="150">

            <br>
                <a href="<?= base_url('admin/libros/'. $libro['id_libro']) ?>">
                    View Book
                </a>
                &nbsp;

                <?php
                $session = session();
                if(!empty($session->get('user'))) {
                    ?>
                    <a href="<?= base_url('admin/deleteBook/'.$libro['id_libro'])?>">
                        Delete Book
                    </a>
                    &nbsp;
                    <a href="<?= base_url('admin/updateWonderForm/'.$libro['id_libro'])?>">
                        Update Book
                    </a>
                    <?php
                }
                ?>
                <br>
            <?php endforeach ?>

        <?php else: ?>

            <h3>No Books</h3>

            <p>Unable to find any book for you.</p>

        <?php endif ?>
    </section>

    <section>
        <?php
        if(!empty($session->get('user'))) {
            ?>
            <a href="<?= base_url('admin/createBookForm')?>">
                Add New Book
            </a>
            <?php
        }
        ?>

    </section>
</main>