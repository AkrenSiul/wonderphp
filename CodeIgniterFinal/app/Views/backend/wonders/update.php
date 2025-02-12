<section>
    <h2><?= esc($title) ?></h2>

    <?= session()->getFlashdata('error')?>
    <?= validation_list_errors() ?>

    <?php if ($wonders !== []): ?>
        <form action="<?= base_url('admin/updateWonder/'.$wonders['id'])?>" method="post"
              enctype="multipart/form-data">
            <?= csrf_field() ?>

            <label for="wonder">Title</label>
            <input type="input" name="wonder" value="<?= esc($wonders['wonder']) ?>">
            <br>
            <label for="location">Location</label>
            <input type="input" name="location" value="<?= esc($wonders['location']) ?>">
            <br>

            <br><br>
            <img src="<?= base_url('assets/img/'.$wonders['image'])?>" width="300px">
            <input type="hidden" name="img_wonder" value="<?= $wonders['image']?>">
            <br>
            <br>
            <label for="image">New image</label>
            <input type="file" name="image">
            <br>
            <br>
            <input type="submit" name="submit" value="Updated Wonder">
        </form>

    <?php endif ?>
</section>
