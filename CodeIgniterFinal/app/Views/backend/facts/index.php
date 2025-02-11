<section>
    <h2><?= esc($title) ?></h2>

    <?php if ($facts !== []): ?>

        <?php foreach ($facts as $fact): ?>

            <h3><?= esc($fact['fact_text']) ?></h3>

            <div class="main">
                <?= esc($fact['wonder']) ?>
            </div>

                <?php
                $session = session();
                if(!empty($session->get('user'))) {
                    ?>
                    <a href="<?= base_url('admin/deleteFact/'.$fact['id'])?>">
                        Delete Fact
                    </a>
                    &nbsp;
                    <a href="<?= base_url('admin/updateFactForm/'.$fact['id'])?>">
                        Update Fact
                    </a>
                    <?php
                }
                ?>
        <?php endforeach ?>

    <?php else: ?>

        <h3>No Fact</h3>

        <p>Unable to find any fact for you.</p>

    <?php endif ?>
</section>

<section>
    <?php
    if(!empty($session->get('user'))) {
        ?>
        <a href="<?= base_url('news/new')?>">
            Add New Fact
        </a>
        <?php
    }
    ?>

</section>
