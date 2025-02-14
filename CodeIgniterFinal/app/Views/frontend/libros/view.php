
<div class="container" >
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light"><?= esc($title)?></h1>
                <br>
            </div>
    </section>


    <?php if ($libro_selected !== []): ?>
        <div class="row mb-2">

            <div class="col-md-8">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col-auto d-none d-lg-block">
                        <img  width="400px" height="250px"
                              src="<?= base_url('assets/img/'. $libro_selected['portada'])?>"
                              alt ="<?php esc($libro_selected['titulo'])?>">
                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0"><?= $libro_selected['titulo']?></h3>
                        <br>
                        <strong class="d-inline-block mb-2 text-success-emphasis"><?= $libro_selected['autor']?></strong>
                        <br>
                        <h5 class="text-end"><?= $libro_selected['precio']?>€</h5>
                    </div>

                </div>
            </div>
        </div>
    <?php endif ?>
</div>
