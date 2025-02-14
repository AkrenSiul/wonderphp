<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light"><?= esc($title)?></h1>
            <br>
        </div>
        <?php if ($libros !== []): ?>

</section>

<div class="album py-5 bg-body-tertiary">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($libros as $new_libro): ?>
                <div class="col">
                    <div class="card shadow-sm">

                        <a href="<?= base_url('libros/').$new_libro['id_libro'];?>">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="225"
                                 src="<?= base_url('assets/img/'.$new_libro['portada'])?>"
                                 alt ="<?php esc($new_libro['titulo'])?>">
                        </a>

                        <div class="card-body">
                            <p class="card-text text-center"><b><?= esc($new_libro['titulo'])?></b></p>
                        </div>
                    </div>
                </div>
            <?php endforeach?>
            <?php else:?>
            <?php endif?>
        </div>
    </div>
</div>

