<?php get_header(); ?>


    <main>
      <!-- 下層ページのmv -->
      <section class="sub-mv">
        <div class="sub-mv__inner">
          <div class="sub-mv__header">
            <h1 class="sub-mv__title">Information</h1>
          </div>
          <div class="sub-mv__img">
            <picture>
              <source media="(min-width: 768px)" srcset="<?php echo esc_url(get_theme_file_uri('/assets/images/common/abstract3.jpeg')); ?>"/>
              <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/abstract33.jpeg')); ?>" alt="<?php echo esc_attr('写真:鮮やかな赤、青、黄色の色彩が交差し、動的なエネルギーを感じさせる抽象画です。'); ?>" />
            </picture>
          </div>
        </div>
      </section>

      <!-- パンくず -->
      <?php get_template_part('parts/breadcrumb'); ?>

      <!-- sub-information -->
      <section class="sub-information sub-information-spacing sub-layout sub-layout--information">
        <div class="sub-information__inner inner">
          <div class="sub-information__tab-second tab-second">
            <ul class="tab-second__menu">
              <li class="tab-second__item js-tab-second is-active" data-number="tab01"><?php echo esc_html('常設'); ?><br class="u-mobile"><?php echo esc_html('展示'); ?></li>
              <li class="tab-second__item js-tab-second" data-number="tab02"><?php echo esc_html('特別'); ?><br class="u-mobile"><?php echo esc_html('展示'); ?></li>
              <li class="tab-second__item js-tab-second" data-number="tab03"><?php echo esc_html('ワーク'); ?><br class="u-mobile"><?php echo esc_html('ショップ'); ?></li>
            </ul>
            <ul class="sub-information__info-tab info-tab">
              <li id="tab01" class="info-tab__item js-tab-second-content is-active">
                <div class="info-tab__wrapper">
                  <div class="info-tab__box">
                    <h2 class="info-tab__title"><?php echo esc_html('常設展示'); ?></h2>
                    <p class="info-tab__text">
                      <?php echo esc_html('当館の常設展示「アートの旅」では、古代から現代までの多彩なアート作品を展示しています。この展示では、絵画、彫刻、工芸品など、さまざまな時代やスタイルの芸術作品を鑑賞することができます。'); ?>
                    </p>
                  </div>
                  <div class="info-tab__img">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/information-img.jpeg')); ?>" alt="<?php echo esc_attr('写真:薄暗いギャラリーに展示された数枚の絵画と資料。'); ?>">
                  </div>
                </div>
              </li>
              <li id="tab02" class="info-tab__item js-tab-second-content">
                <div class="info-tab__wrapper">
                  <div class="info-tab__box">
                    <h2 class="info-tab__title"><?php echo esc_html('特別展示'); ?></h2>
                    <p class="info-tab__text">
                      <?php echo esc_html('当館では定期的に特別展示を開催し、テーマに沿った選りすぐりの作品を展示しています。特別展示では、国内外の著名なアーティストの最新作や、一般公開されていないプライベートコレクションを紹介することが多く、限られた期間しか開催されないため、見逃せない貴重な機会です。'); ?>
                    </p>
                  </div>
                  <div class="info-tab__img">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/information7.jpeg')); ?>" alt="<?php echo esc_attr('写真:白い額縁と緑の葉.'); ?>">
                  </div>
                </div>
              </li>
              <li id="tab03" class="info-tab__item js-tab-second-content">
                <div class="info-tab__wrapper">
                  <div class="info-tab__box">
                    <h2 class="info-tab__title"><?php echo esc_html('ワークショップ'); ?></h2>
                    <p class="info-tab__text">
                      <?php echo esc_html('当館では、アートに触れ、学び、創作する機会を提供するため、さまざまなワークショップを開催しています。初心者からプロフェッショナルまで、幅広いレベルの参加者が楽しめるプログラムを用意しています。'); ?>
                    </p>
                  </div>
                  <div class="info-tab__img">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/information8.jpeg')); ?>" alt="<?php echo esc_attr('写真:カラフルな絵の具がたくさん並んでいる。'); ?>">
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </section>


<?php get_footer(); ?>