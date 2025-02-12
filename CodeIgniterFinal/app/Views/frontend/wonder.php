
    <div class="container" >
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light"><?= esc($title)?></h1>
                    <br>
                    <h4 class="text-body-secondary">
                        Choose a Wonder to discover its facts
                    </h4>
                </div>
                <?php if ($wonders !== []): ?>

                <div>
                    <p>
                        <?php foreach ($wonders as $new_wonder): ?>
                            <a href="<?= base_url('wonder/').$new_wonder['id'];?>"
                               class="btn btn-primary my-2"><?= esc($new_wonder['wonder'])?></a>
                        <?php endforeach?>
                    </p>
                    <p>
                        <a href="<?= base_url('/');?>" class="btn btn-outline-primary my-2">Mostrar todas</a>
                    </p>
                </div>
                <?php endif ?>
            </div>
        </section>


        <?php if ($wonder_selected !== []): ?>
        <div class="row mb-2">

            <div class="col-md-12">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col-auto d-none d-lg-block">
                        <img  width="400px" height="250px"
                             src="<?= base_url('assets/img/'.$wonder_selected['image'])?>"
                             alt ="<?php esc($wonder_selected['wonder'])?>">
                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success-emphasis"><?= $wonder_selected['location']?></strong>
                        <h3 class="mb-0"><?= $wonder_selected['wonder']?></h3>
                        <br>
                        <h5>FACTS</h5>
                        <?php foreach($wonder_facts as $fact):?>
                        <p class="mb-auto"><?= $fact['fact_text']?></p>
                        <?php endforeach ?>

                    </div>

                </div>
            </div>
        </div>
        <?php endif ?>
    </div>
</main>
