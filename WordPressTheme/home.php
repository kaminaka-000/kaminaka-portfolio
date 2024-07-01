<?php get_header(); ?>

<main>
      <!-- 下層ページのmv -->
      <section class="sub-mv">
        <div class="sub-mv__inner">
          <div class="sub-mv__header">
            <h1 class="sub-mv__title">Blog</h1>
          </div>
          <div class="sub-mv__img">
            <picture>
              <source media="(min-width: 768px)" srcset="<?php echo esc_url(get_theme_file_uri('/assets/images/common/sub-blog-mv-pc.jpeg')); ?>"/>
              <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/sub-blog-mv.jpeg')); ?>" alt="<?php echo esc_attr('写真:水中で群れをなす無数の魚が海の光に照らされている。'); ?>" />
            </picture>
          </div>
        </div>
      </section>

      <!-- パンくず -->
      <?php get_template_part('parts/breadcrumb'); ?>

      <!-- blog-section -->
      <section class="blog-section sub-blog-section-spacing sub-layout">
        <div class="blog-section__inner inner">
          <div class="blog-section__wrapper blog-section__wrapper--home">
            <ul class="blog-section__cards cards cards--blog-section <?php if (!have_posts()) echo 'cards-no-posts'; ?>">
              <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                <li class="cards__item">
                  <a href="<?php echo esc_url(get_permalink()); ?>" class="card">
                    <div class="card__img">
                      <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>のアイキャッチ画像。">
                      <?php else : ?>
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/no_image.jpeg')); ?>" alt="画像がありません。">
                      <?php endif; ?>
                    </div>
                    <div class="card__content">
                      <time class="card__meta" datetime="<?php echo esc_attr(get_the_time('c')); ?>"><?php echo esc_html(get_the_time('Y.m.d')); ?></time>
                      <h2 class="card__title"><?php echo esc_html(get_the_title()); ?></h2>
                      <p class="card__text">
                        <?php echo esc_html(wp_trim_words(get_the_excerpt(), 85, '')); ?>
                      </p>
                    </div>
                  </a>
                </li>
                <?php endwhile; ?>
              <?php else : ?>
                <li class="cards__content">
                  <p class="cards__content-text">投稿がありません。</p>
                </li>
              <?php endif; ?>
            </ul>
            <!-- ページネーション -->
            <?php if (have_posts()) : ?>
              <div class="blog-section__pagenavi pagenavi sub-pagenavi-spacing">
                <?php wp_pagenavi(); ?>
              </div>
            <?php endif; ?>
          </div>
          <!-- サイドバー -->
          <div class="blog-section__sidebar blog-section__sidebar--single">
            <?php get_sidebar(); ?>
          </div>
        </div>
      </section>


    <?php get_footer(); ?>