<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />

    <?php wp_head(); ?>
  </head>
  <body>
    <?php
        $campaign = esc_url(home_url('/campaign/'));
        $information = esc_url(home_url('/information/'));
        $about_us = esc_url(home_url('/about-us/'));
        $blog = esc_url(home_url('/blog/'));
        $voice = esc_url(home_url('/voice/'));
        $price = esc_url(home_url('/price/'));
        $faq = esc_url(home_url('/faq/'));
        $privacypolicy = esc_url(home_url('/privacypolicy/'));
        $terms_of_service = esc_url(home_url('/terms-of-service/'));
        $contact = esc_url(home_url('/contact/'));
        $sitemap = esc_url(home_url('/sitemap/'));
    ?>
    <!-- header -->
    <header class="header">
      <div class="header__inner">
        <div class="header__logo">
          <a href="<?php echo esc_url(home_url()); ?>">
            <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/art-logo.png')); ?>" alt="ロゴ:蓮池美術館" />
          </a>
        </div>
        <button class="header__hamburger header-hamburger js-header-hamburger">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <nav class="header__nav-pc nav-pc">
          <ul class="nav-pc__items">
            <li class="nav-pc__item">
              <a href="<?php echo $campaign; ?>">Art<span>作品紹介</span></a>
            </li>
            <li class="nav-pc__item">
              <a href="<?php echo $about_us; ?>">About us<span>当館について</span></a>
            </li>
            <li class="nav-pc__item">
              <a href="<?php echo $information; ?>">Information<span>展示情報</span></a>
            </li>
            <li class="nav-pc__item">
              <a href="<?php echo $blog; ?>">Blog<span>ブログ</span></a>
            </li>
            <li class="nav-pc__item">
              <a href="<?php echo $voice; ?>">Voice<span>お客様の声</span></a>
            </li>
            <li class="nav-pc__item">
              <a href="<?php echo $price; ?>">Price<span>料金一覧</span></a>
            </li>
            <li class="nav-pc__item">
              <a href="<?php echo $faq; ?>">FAQ<span>よくある質問</span></a>
            </li>
            <li class="nav-pc__item">
              <a href="<?php echo $contact; ?>">Contact<span>お問い合わせ</span></a>
            </li>
          </ul>
        </nav>

        <nav class="header__nav nav js-nav">
          <div class="nav__inner">
            <div class="nav__area">
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
                        $terms = get_terms(array(
                          'taxonomy' => 'campaign_category',
                          'hide_empty' => false,
                        ));

                        // 取得した用語をループしてリンクを生成します
                        foreach ($terms as $term) {
                          echo '<li class="nav__item"><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
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
                      <a href="<?php echo esc_url($information . '?tab=tab01'); ?>">常設展示</a>
                    </li>
                    <li class="nav__item">
                      <a href="<?php echo esc_url($information . '?tab=tab03'); ?>">特別展示</a>
                    </li>
                    <li class="nav__item">
                      <a href="<?php echo esc_url($information . '?tab=tab02'); ?>">ワークショップ</a>
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
                      <a href="<?php echo esc_url($price . '#sub-price-license'); ?>">入館料</a>
                    </li>
                    <li class="nav__item">
                      <a href="<?php echo esc_url($price . '#sub-price-experience'); ?>">特別展</a>
                    </li>
                    <li class="nav__item">
                      <a href="<?php echo esc_url($price . '#sub-price-fan'); ?>">年間パスポート</a>
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
                          <span>プライバシー<br class="u-mobile"/>ポリシー</span>
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
    </header>