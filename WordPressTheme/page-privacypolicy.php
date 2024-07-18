<?php get_header(); ?>

    <main>
      <!-- 下層ページのmv -->
      <section class="sub-mv">
        <div class="sub-mv__inner">
          <div class="sub-mv__header">
            <h1 class="sub-mv__title">Privacy Policy</h1>
          </div>
          <div class="sub-mv__img">
            <picture>
              <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/conditions.jpeg"/>
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/conditions-sp.jpeg" alt="写真:青と白の抽象画。ダイナミックな筆致が青と白の濃淡を表現し、エネルギッシュで動きのある印象を与える。テクスチャーが強調され、色のコントラストが際立つ美しいアートワーク。" />
            </picture>
          </div>
        </div>
      </section>

      <!-- パンくず -->
      <?php get_template_part('parts/breadcrumb'); ?>

      <!-- privacy-policy -->
      <section class="privacy-policy sub-privacy-policy-spacing sub-layout">
        <div class="privacy-policy__inner inner">
          <h2 class="privacy-policy__title"><?php echo esc_html(get_the_title()); ?></h2>
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php echo wp_kses_post(get_the_content()); ?>
          <?php endwhile; endif; ?>
        </div>
      </section>

    <?php get_footer(); ?>
