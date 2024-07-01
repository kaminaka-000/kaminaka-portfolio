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
              <source media="(min-width: 768px)" srcset="<?php echo esc_url(get_theme_file_uri('/assets/images/common/sub-information-pc.jpeg')); ?>"/>
              <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/sub-information.jpeg')); ?>" alt="<?php echo esc_attr('写真:サンゴ礁を探検するダイバーと群れをなす黄色い魚。'); ?>" />
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
              <li class="tab-second__item js-tab-second is-active" data-number="tab01"><?php echo esc_html('ライセンス'); ?><br class="u-mobile"><?php echo esc_html('講習'); ?></li>
              <li class="tab-second__item js-tab-second" data-number="tab02"><?php echo esc_html('ファン'); ?><br class="u-mobile"><?php echo esc_html('ダイビング'); ?></li>
              <li class="tab-second__item js-tab-second" data-number="tab03"><?php echo esc_html('体験'); ?><br class="u-mobile"><?php echo esc_html('ダイビング'); ?></li>
            </ul>
            <ul class="sub-information__info-tab info-tab">
              <li id="tab01" class="info-tab__item js-tab-second-content is-active">
                <div class="info-tab__wrapper">
                  <div class="info-tab__box">
                    <h2 class="info-tab__title"><?php echo esc_html('ライセンス講習'); ?></h2>
                    <p class="info-tab__text">
                      <?php echo esc_html('泳げない人も、ちょっと水が苦手な人も、ダイビングを「安全に」楽しんでいただけるよう、スタッフがサポートいたします！スキューバダイビングを楽しむためには最低限の知識とスキルが要求されます。知識やスキルと言ってもそんなに難しい事ではなく、安全に楽しむ事を目的としたものです。プロダイバーの指導のもと知識とスキルを習得しCカードを取得して、ダイバーになろう！'); ?>
                    </p>
                  </div>
                  <div class="info-tab__img">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/sub-information-img1.jpeg')); ?>" alt="<?php echo esc_attr('写真:海面でダイビングをしている5人の人たち。'); ?>">
                  </div>
                </div>
              </li>
              <li id="tab02" class="info-tab__item js-tab-second-content">
                <div class="info-tab__wrapper">
                  <div class="info-tab__box">
                    <h2 class="info-tab__title"><?php echo esc_html('ファンダイビング'); ?></h2>
                    <p class="info-tab__text">
                      <?php echo esc_html('ブランクダイバー、ライセンスを取り立ての方も安心！沖縄本島を代表する「青の洞窟」（真栄田岬）やケラマ諸島などメジャーなポイントはモチロンのこと、最北端「辺戸岬」や最南端の「大渡海岸」等もご用意！'); ?>
                    </p>
                  </div>
                  <div class="info-tab__img">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/sub-information-img2.jpeg')); ?>" alt="<?php echo esc_attr('写真:鮮やかな青い海中に群れをなして泳ぐ熱帯魚。'); ?>">
                  </div>
                </div>
              </li>
              <li id="tab03" class="info-tab__item js-tab-second-content">
                <div class="info-tab__wrapper">
                  <div class="info-tab__box">
                    <h2 class="info-tab__title"><?php echo esc_html('体験ダイビング'); ?></h2>
                    <p class="info-tab__text">
                      <?php echo esc_html('ブランクダイバー、ライセンスを取り立ての方も安心！沖縄本島を代表する「青の洞窟」（真栄田岬）やケラマ諸島などメジャーなポイントはモチロンのこと、最北端「辺戸岬」や最南端の「大渡海岸」等もご用意！'); ?>
                    </p>
                  </div>
                  <div class="info-tab__img">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/sub-information-img3.jpeg')); ?>" alt="<?php echo esc_attr('写真:二匹の熱帯魚が透明な海水の中を泳いでいる。'); ?>">
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </section>


<?php get_footer(); ?>