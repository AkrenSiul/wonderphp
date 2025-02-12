<section>

    <?php if ($wonders !== []): ?>

        <?php foreach ($wonders as $wonder): ?>

            <img src="<?= base_url('assets/img/'.$wonder['image']) ?>"
            width="300" height="150">

            <div class="main">
                <?= esc($wonder['wonder']) ?>
            </div>

            <a href="<?= base_url('admin/wonder/'. $wonder['id']) ?>">
                View article
            </a>
            &nbsp;

            <?php
            $session = session();
            if(!empty($session->get('user'))) {
                ?>
                <a href="<?= base_url('admin/deleteWonder/'.$wonder['id'])?>">
                    Delete Wonder
                </a>
                &nbsp;
                <a href="<?= base_url('admin/updateWonderForm/'.$wonder['id'])?>">
                    Update Wonder
                </a>
                <?php
            }
            ?>
            <br>
        <?php endforeach ?>

    <?php else: ?>

        <h3>No Wonder</h3>

        <p>Unable to find any wonder for you.</p>

    <?php endif ?>
</section>

<section>
    <?php
    if(!empty($session->get('user'))) {
        ?>
        <a href="<?= base_url('admin/createWonderForm')?>">
            Add New Wonder
        </a>
        <?php
    }
    ?>

</section>
