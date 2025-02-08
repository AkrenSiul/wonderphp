<main>
    <div class="container">

        <?php if ($wonder_selected !== []): ?>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col">
                <div class="card shadow-sm">
                    <!--                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"-->
                    <!--                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"-->
                    <!--                             preserveAspectRatio="xMidYMid slice" focusable="false">-->
                    <!--                            <title>Placeholder</title>-->
                    <!--                            <rect width="100%" height="100%" fill="#55595c"/>-->
                    <!--                            <text x="50%" y="50%" fill="#eceeef" dy=".3em"></text>-->
                    <!--                            --><?php //= base_url('assets/img/'.$new_wonder['image'])?>
                    <!--                        </svg>-->
                    <a href="">
                        <img class="bd-placeholder-img card-img-top" width="100%" height="225"
                             src="<?= base_url('assets/img/'.$wonder_selected['image'])?>"
                             alt ="<?php $wonder_selected['wonder']?>">
                    </a>

                    <div class="card-body">
                        <p class="card-text"><?= 'fsafas';?></p>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <?php endif ?>
        </div>
    </div>
</main>
