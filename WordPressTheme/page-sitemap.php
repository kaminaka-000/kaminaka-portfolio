<?php get_header(); ?>

      <!-- 下層ページのmv -->
      <section class="sub-mv">
        <div class="sub-mv__inner">
          <div class="sub-mv__header">
            <h1 class="sub-mv__title">Site MAP</h1>
          </div>
          <div class="sub-mv__img">
            <picture>
              <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/sitemap-mv-pc.jpeg"/>
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/sitemap-mv.jpeg" alt="写真:サンゴ礁の上を泳ぐカラフルな熱帯魚の群れ。" />
            </picture>
          </div>
        </div>
      </section>

      <!-- パンくず -->
      <?php get_template_part('parts/breadcrumb'); ?>


      <?php
            $campaign = esc_url( home_url( '/campaign/' ) );
            $information = esc_url( home_url( '/information/' ) );
            $about_us = esc_url( home_url( '/about-us/' ) );
            $blog = esc_url( home_url( '/blog/' ) );
            $voice = esc_url( home_url( '/voice/' ) );
            $price = esc_url( home_url( '/price/' ) );
            $faq = esc_url( home_url( '/faq/' ) );
            $faq = esc_url( home_url( '/privacypolic/' ) );
            $privacypolicy = esc_url( home_url( '/privacypolicy/' ) );
            $terms_of_service = esc_url( home_url( '/terms-of-service/' ) );
            $contact = esc_url( home_url( '/contact/' ) );
            $sitemap = esc_url( home_url( '/sitemap/' ) );
        ?>

        <!-- sitemap -->
        <section class="sitemap sub-sitemap-spacing">
        <div class="sitemap__inner inner">
          <nav class="sitemap__nav nav nav--sitemap">
            <div class="nav__inner nav__inner--footer">
              <div class="nav__area nav__area--footer nav__area--sitemap">
                <div class="nav__section">
                  <div class="nav__content">
                    <ul class="nav__items">
                      <li class="nav__item">
                        <a href="<?php echo $campaign; ?>">
                          <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                            <span>キャンペーン</span>
                          </div>
                        </a>
                      </li>
                      <?php
                        // ここで get_terms を使用してカスタムタクソノミーの用語を取得します
                        $terms = get_terms( array(
                          'taxonomy' => 'campaign_category',
                          'hide_empty' => false,
                        ) );

                        // 取得した用語をループしてリンクを生成します
                        foreach( $terms as $term ) {
                          echo '<li class="nav__item"><a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a></li>';
                        }
                      ?>
                    </ul>
                  </div>
                  <div class="nav__content">
                    <ul class="nav__items">
                      <li class="nav__item">
                        <a href="<?php echo $about_us; ?>">
                          <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                            <span>私たちについて</span>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="nav__section">
                  <div class="nav__content">
                    <ul class="nav__items">
                      <li class="nav__item">
                        <a href="<?php echo $information; ?>">
                          <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                            <span>ダイビング情報</span>
                          </div>
                        </a>
                      </li>
                      <li class="nav__item">
                        <a href="<?php echo $information; ?>?tab=tab01">ライセンス講習</a>
                      </li>
                      <li class="nav__item">
                        <a href="<?php echo $information; ?>?tab=tab03">体験ダイビング</a>
                      </li>
                      <li class="nav__item">
                        <a href="<?php echo $information; ?>?tab=tab02">ファンダイビング</a>
                      </li>
                    </ul>
                  </div>
                  <div class="nav__content">
                    <ul class="nav__items">
                      <li class="nav__item">
                        <a href="<?php echo $blog; ?>">
                          <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                            <span>ブログ</span>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="nav__section">
                  <div class="nav__content">
                    <ul class="nav__items">
                      <li class="nav__item">
                        <a href="<?php echo $voice; ?>">
                          <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                            <span>お客様の声</span>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="nav__content">
                    <ul class="nav__items">
                      <li class="nav__item">
                        <a href="<?php echo $price; ?>">
                          <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                            <span>料金一覧</span>
                          </div>
                        </a>
                      </li>
                      <li class="nav__item">
                        <a href="<?php echo $price; ?>#sub-price-license">ライセンス講習</a>
                      </li>
                      <li class="nav__item">
                        <a href="<?php echo $price; ?>#sub-price-experience">体験ダイビング</a>
                      </li>
                      <li class="nav__item">
                        <a href="<?php echo $price; ?>#sub-price-fan">ファンダイビング</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="nav__section">
                  <div class="nav__content">
                    <ul class="nav__items">
                      <li class="nav__item">
                        <a href="<?php echo $faq; ?>">
                          <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                            <span>よくある質問</span>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="nav__content">
                    <ul class="nav__items">
                      <li class="nav__item">
                        <a href="<?php echo $privacypolicy; ?>">
                          <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                            <span>プライバシー<br class="u-mobile" />ポリシー</span>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="nav__content">
                    <ul class="nav__items">
                      <li class="nav__item">
                        <a href="<?php echo $terms_of_service; ?>">
                          <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                            <span>利用規約</span>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="nav__content">
                    <ul class="nav__items">
                      <li class="nav__item">
                        <a href="<?php echo $contact; ?>">
                          <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                            <span>お問い合わせ</span>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="nav__content">
                  <ul class="nav__items">
                    <li class="nav__item">
                      <a href="<?php echo $sitemap; ?>">
                        <div class="nav__item-wrapper nav__item-wrapper--sitemap">
                          <span>サイトマップ</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </section>

    <?php get_footer(); ?>