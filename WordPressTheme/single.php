<?php get_header(); ?>

    <?php
        if (is_single()) {
            set_post_view(get_the_ID());
        }
    ?>

    <main>
      <!-- 下層ページのmv -->
      <section class="sub-mv">
        <div class="sub-mv__inner">
          <div class="sub-mv__header">
            <h2 class="sub-mv__title">Blog</h2>
          </div>
          <div class="sub-mv__img">
            <picture>
              <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/abstract4.jpeg"/>
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/abstract44.jpeg" alt="写真:青と茶色のぼかしがかった色調で描かれた抽象画。" />
            </picture>
          </div>
        </div>
      </section>

      <!-- パンくず -->
      <?php get_template_part('parts/breadcrumb'); ?>

      <!-- blog-section -->
      <section class="blog-section sub-blog-section-spacing sub-layout">
        <div class="blog-section__inner inner">
          <div class="blog-section__wrapper">
          <?php if (have_posts()) : ?>
            <?php while(have_posts()) : ?>
                <?php the_post(); ?>
            <div class="blog-section__article-body article-body">
              <time class="article-body__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.m/d'); ?></time>
              <h1 class="article-body__title"><?php the_title(); ?></h1>
              <div class="article-body__img">
                <?php if ( has_post_thumbnail() ): ?>
                  <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>のアイキャッチ画像。">
                <?php else: ?>
                  <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/no_image.jpeg" alt="画像がありません。">
                <?php endif; ?>
              </div>
              <div class="article-body__content">
              <?php the_content(); ?>
              </div>
              <!-- ページネーション -->
              <div class="article-body__pagenavi">
                <div class="article-body__pagenavi-inner inner">
                  <div class="wp-pagenavi" role="navigation">
                    <?php previous_post_link('<span class="previouspostslink" rel="prev">%link</span>', '＜'); ?>
                    <?php next_post_link('<span class="nextpostslink" rel="next">%link</span>', '＞'); ?>
                  </div>
                </div>
              </div>
            </div>
            <?php endwhile; endif; ?>
          </div>
          <!-- サイドバー -->
          <div class="blog-section__sidebar blog-section__sidebar--single">
            <?php get_sidebar(); ?>
          </div>
        </div>
      </section>

    <?php get_footer(); ?>
