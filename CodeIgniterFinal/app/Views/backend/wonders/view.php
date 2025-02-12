<section>
    <h2><?= esc($wonder_selected['wonder']) ?></h2>
    <p><?= esc($wonder_selected['location']) ?></p>
    <p><img src="<?= base_url('assets/img/'. $wonder_selected['image']);?>" width="400" height="300">
    </p>
    <br>
    <?php
    $session = session();
    if(!empty($session->get('user'))) {
        ?>
        <a href="<?= base_url('admin/deleteWonder/'.$wonder_selected['id'])?>">
            Delete Wonder
        </a>
        &nbsp;
        <a href="<?= base_url('admin/updateWonderForm/'.$wonder_selected['id'])?>">
            Update Wonder
        </a>
        <?php
    }
    ?>
    <p>
        <a href="<?= base_url('admin/wonders')?>">
            Volver a Wonders
        </a>
    </p>
</section>