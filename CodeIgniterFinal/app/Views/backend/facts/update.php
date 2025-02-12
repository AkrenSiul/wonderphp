<section>
    <h2><?= esc($title) ?></h2>

    <?= session()->getFlashdata('error') ?>
    <?= validation_list_errors() ?>

    <?php if($fact !== []):?>
    <form action="<?= base_url('admin/updateFact/'.$fact['fact_id'])?>" method="post" <!-- enctype="multipart/form-data"-->
    <?= csrf_field() ?>

    <label for="facts">Facts</label>
    <input type="input" name="fact_text" value="<?= esc($fact['fact_text']) ?>" size="100">
    <br>

    <label for="wonders">Wonder:</label>
    <select name="wonder_id">
        <?php if ($wonders !== []): ?>
            <?php foreach($wonders as $wonder_item) : ?>
                <option value="<?= $wonder_item['id']?>"
                <?= $wonder_item['id']==$fact['wonder_id']? 'selected' : ''?>
                >
                    <?= $wonder_item['wonder']?>
                </option>
            <?php endforeach ?>
        <?php endif ?>
    </select>
    <br><br>
    <input type="submit" name="submit" value="Update fact">
    </form>
    <?php endif?>
</section>