<?php

// Block Name: Fun Facts

$id = 'fun-facts-' . $block['id'];
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>

<div class="fun-facts" <?php echo $align_class; ?> id="<?php echo $id; ?>">
    <h4><?php the_field('title'); ?></h4>
    <div class="fact-description"><?php the_field('description'); ?></div>
</div>

<style type="text/css">
    .fun-facts {
        background:rgba(236, 236, 236, 0.4);
        border: 1px solid #c0c0c0;
        margin: 15px;
        padding: 25px;
        border-radius: 1rem;
    }

    .fun-facts h4 {
        margin-top: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid #c0c0c0;
    }
</style>