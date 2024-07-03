    <?php
      $campaign = esc_url( home_url( '/campaign/' ) );
      $information = esc_url( home_url( '/information/' ) );
      $about_us = esc_url( home_url( '/about-us/' ) );
      $blog = esc_url( home_url( '/blog/' ) );
      $voice = esc_url( home_url( '/voice/' ) );
      $price = esc_url( home_url( '/price/' ) );
      $faq = esc_url( home_url( '/faq/' ) );
      $privacypolicy = esc_url( home_url( '/privacypolicy/' ) );
      $terms_of_service = esc_url( home_url( '/terms-of-service/' ) );
      $contact = esc_url( home_url( '/contact/' ) );
      $sitemap = esc_url( home_url( '/sitemap/' ) );
      ?>

      <?php if (!(is_page('contact') || is_page('contact-thanks') || is_404())) : ?>
        <!-- contact -->
        <section class="contact top-contact">
        <div class="contact__inner">
          <div class="contact__layout">
            <div class="contact__wrapper">
              <div class="contact__logo">
                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/art-logo78.png" alt="ロゴ:かみなか美術館"/>
              </div>
              <div class="contact__address">
                <address class="contact__body">
                  <p>東京都台東区上野1-22</p>
                  <p><a href="tel:0120-000-0000">TEL:0120-000-0000</a></p>
                  <p>営業時間:9:00-18:00</p>
                  <p>定休日:月曜日</p>
                </address>
                <div class="contact__map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5652.213600445425!2d139.76668887755363!3d35.714565053347165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188e9e8b28ebb3%3A0x9bba88ca3db2f4be!2z44CSMTEwLTAwMDUg5p2x5Lqs6YO95Y-w5p2x5Yy65LiK6YeO!5e0!3m2!1sja!2sjp!4v1718278053681!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>
            </div>
            <span class="contact__line"></span>
            <div class="contact__box">
              <div class="contact__title heading">
                <h2 class="heading__engtitle heading__engtitle--contact">Contact</h2>
                <p class="heading__jatitle heading__jatitle--contact">お問い合わせ</p>
              </div>
              <p class="contact__text">ご予約・お問い合わせはコチラ</p>
              <div class="contact__button">
                <a href="<?php echo home_url('/contact/'); ?>" class="button"><span>Contact us</span></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php endif; ?>

    <!-- to-top -->
    <a href="#top" class="to-top">
      <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/to-top.svg" alt=""/>
    </a>

    <!-- footer -->
    <footer class="footer top-footer<?php if (is_404()) echo ' top-footer--not-found'; ?>">
      <div class="footer__inner inner">
        <div class="footer__group">
          <div class="footer__logo">
            <a href="<?php echo home_url(); ?>">
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/art-logo77.png" alt="ロゴ:かみなか美術館"/>
            </a>
          </div>
          <div class="footer__icons">
            <div class="footer__icon">
              <a href="https://www.facebook.com/?locale=ja_JP" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/facebooklogo.svg" alt="アイコン:facebook"/>
              </a>
            </div>
            <div class="footer__icon">
              <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/instagramlogo.svg" alt="アイコン:instagram"/>
              </a>
            </div>
            <div class="footer__icon footer__icon--x">
              <a href="https://x.com/home?lang=ja" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/logox.svg" alt="アイコン:X"/>
              </a>
            </div>
          </div>
        </div>
        <nav class="footer__nav nav">
          <div class="nav__inner nav__inner--footer">
            <div class="nav__area nav__area--footer">
              <div class="nav__section">
                <div class="nav__content">
                  <ul class="nav__items">
                    <li class="nav__item">
                      <a href="<?php echo $campaign; ?>">
                        <div class="nav__item-wrapper">
                          <span>作品紹介</span>
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
                        <div class="nav__item-wrapper">
                          <span>当館について</span>
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
                        <div class="nav__item-wrapper">
                          <span>展示情報</span>
                        </div>
                      </a>
                    </li>
                    <li class="nav__item">
                      <a href="<?php echo $information; ?>?tab=tab01">常設展示</a>
                    </li>
                    <li class="nav__item">
                      <a href="<?php echo $information; ?>?tab=tab03">特別展示</a>
                    </li>
                    <li class="nav__item">
                      <a href="<?php echo $information; ?>?tab=tab02">イベント</a>
                    </li>
                  </ul>
                </div>
                <div class="nav__content">
                  <ul class="nav__items">
                    <li class="nav__item">
                      <a href="<?php echo $blog; ?>">
                        <div class="nav__item-wrapper">
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
                        <div class="nav__item-wrapper">
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
                        <div class="nav__item-wrapper">
                          <span>料金一覧</span>
                        </div>
                      </a>
                    </li>
                    <li class="nav__item">
                      <a href="<?php echo $price; ?>#sub-price-license">入館料</a>
                    </li>
                    <li class="nav__item">
                      <a href="<?php echo $price; ?>#sub-price-experience">特別展<br class="u-mobile">（入館料を含む）</a>
                    </li>
                    <li class="nav__item">
                      <a href="<?php echo $price; ?>#sub-price-fan">年間パスポート</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="nav__section">
                <div class="nav__content">
                  <ul class="nav__items">
                    <li class="nav__item">
                      <a href="<?php echo $faq; ?>">
                        <div class="nav__item-wrapper">
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
                        <div class="nav__item-wrapper">
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
                        <div class="nav__item-wrapper">
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
                        <div class="nav__item-wrapper">
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
                        <div class="nav__item-wrapper">
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
      <div class="footer__copyright">
        <small>Copyright &copy; 2021 - 2023 CodeUps LLC. All Rights Reserved.</small>
      </div>
    </footer>

    <?php wp_footer(); ?>

  </body>
</html>