<section>

    <?php if ($wonders !== []): ?>

        <?php foreach ($wonders as $wonder): ?>

            <img src="<?= base_url('assets/img/'.$wonder['image']) ?>"
            width="100" height="100">

            <div class="main">
                <?= esc($wonder['wonder']) ?>
            </div>

            <a href="<?= base_url('news/'. $wonder['wonder']) ?>">
                View article
            </a>
            &nbsp;

            <?php
            $session = session();
            if(!empty($session->get('user'))) {
                ?>
                <a href="<?= base_url('admin/deleteFact/'.$wonder['id'])?>">
                    Delete Fact
                </a>
                &nbsp;
                <a href="<?= base_url('admin/updateFactForm/'.$wonder['id'])?>">
                    Update Fact
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
        <a href="<?= base_url('news/new')?>">
            Add New Wonder
        </a>
        <?php
    }
    ?>

</section>
