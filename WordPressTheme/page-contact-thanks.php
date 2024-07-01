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
              <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/sub-contact-mv.jpeg')); ?>" alt="写真:波打ち際。" />
            </picture>
          </div>
        </div>
      </section>

      <!-- パンくず -->
      <?php get_template_part('parts/breadcrumb'); ?>

      <!-- thankyou -->
      <div class="contact-thankyou sub-contact-thankyou-spacing sub-layout">
        <div class="contact-thankyou__inner">
          <p>お問い合わせ内容を送信完了しました。</p>
          <p>このたびは、お問い合わせ頂き<br class="u-mobile">誠にありがとうございます。<br>
            お送り頂きました内容を確認の上、<br class="u-mobile">3営業日以内に折り返しご連絡させて頂きます。<br>
            また、ご記入頂いたメールアドレスへ、<br class="u-mobile">自動返信の確認メールをお送りしております。</p>
        </div>
      </div>
    </main>


<?php get_footer(); ?>