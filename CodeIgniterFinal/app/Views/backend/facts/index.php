<main style="background-color: #dddddd">
    <section>
        <h2><?= esc($title) ?></h2>

        <?php if ($facts !== []): ?>

            <?php foreach ($facts as $fact): ?>

                <h3><?= esc($fact['fact_text']) ?></h3>

                <div class="main">
                    <p><b><?= esc($fact['wonder']) ?></b></p>
                </div>
                <br>

                <?php
                $session = session();
                if(!empty($session->get('user'))) {
                    ?>
                    <a href="<?= base_url('admin/deleteFact/'.$fact['fact_id'])?>">
                        Delete Fact
                    </a>
                    &nbsp;
                    <a href="<?= base_url('admin/updateFactForm/'.$fact['fact_id'])?>">
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
            <a href="<?= base_url('admin/createFactForm')?>">
                Add New Fact
            </a>
            <?php
        }
        ?>

    </section>
</main>

