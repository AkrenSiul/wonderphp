<main>

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

            <div><?php
                $session = session();
                if(empty($session->get('user'))):
                ?>
                <p>
                    <?php foreach ($wonders as $wonder): ?>
                    <a href="<?= base_url('frontend/wonder/').$wonder['id'];?>"
                       class="btn btn-primary my-2"><?= esc($wonder['wonder'])?></a>
                    <?php endforeach?>
                </p>

                <?php endif;?>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($wonders as $new_wonder): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <a href="<?= base_url('frontend/wonder/').$new_wonder['id'];?>">
                        <img class="bd-placeholder-img card-img-top" width="100%" height="225"
                             src="<?= base_url('assets/img/'.$new_wonder['image'])?>"
                        alt ="<?php esc($new_wonder['wonder'])?>">
                        </a>

                        <div class="card-body">
                            <p class="card-text text-center"><?= esc($new_wonder['wonder'])?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach?>
                <?php else:?>
                <?php endif?>
            </div>
        </div>
    </div>
    <section>
        <?php
                $session = session();
        if(!empty($session->get('user'))) {
            ?>
            <a href="<?= base_url('frontend/new')?>">
                Add New Wonder
            </a>
            <?php
        }
        ?>

    </section>

</main>
