<?php get_header(); ?>

<main>
    <!-- not-found -->
    <div class="not-found sub-not-found-spacing">
        <div class="not-found__inner">
            <!-- パンくず -->
            <?php get_template_part('parts/breadcrumb'); ?>

            <div class="not-found__wrapper">
                <h1 class="not-found__title">404</h1>
                <p class="not-found__text">申し訳ありません。<br>お探しのページが見つかりません。</p>
                <div class="not-found__button">
                    <a href="<?php echo esc_url(home_url()); ?>" class="button button--not-found"><span>Page TOP</span></a>
                </div>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>