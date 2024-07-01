<?php get_header(); ?>

<main>
  <!-- 下層ページのmv -->
  <section class="sub-mv">
    <div class="sub-mv__inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title">Contact</h1>
      </div>
      <div class="sub-mv__img">
        <picture>
          <source media="(min-width: 768px)" srcset="<?php echo esc_url(get_theme_file_uri('/assets/images/common/sub-contact-mv-pc.jpeg')); ?>"/>
          <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/sub-contact-mv.jpeg')); ?>" alt="写真:" />
        </picture>
      </div>
    </div>
  </section>

  <!-- パンくず -->
  <?php get_template_part('parts/breadcrumb'); ?>

  <!-- contact -->
  <section class="sub-contact sub-contact-spacing sub-layout">
    <div class="sub-contact__inner inner">
      <?php echo do_shortcode('[contact-form-7 id="0168f41" title="お問い合わせ"]'); ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>

