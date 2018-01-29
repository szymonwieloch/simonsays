<a href="<?php the_permalink(); ?>">
    <article id="post-<?php the_ID(); ?>"  <?php post_class('entry-box'); ?> >
        <?php the_post_thumbnail('full', array('class' => 'entry-img'));?>
        <div class="entry-content">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-text">
                <?php  the_content('');?>
            </div>
        </div>
    </article>
</a>