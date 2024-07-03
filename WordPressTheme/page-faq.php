<?php get_header(); ?>


<main>
      <!-- 下層ページのmv -->
      <section class="sub-mv">
        <div class="sub-mv__inner">
          <div class="sub-mv__header">
            <h1 class="sub-mv__title">FAQ</h1>
          </div>
          <div class="sub-mv__img">
            <picture>
              <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/abstract7.jpeg"/>
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/abstract77.jpeg" alt="写真:鮮やかな青、黄色、灰色のブロックが重なり合い、ダイナミックでエネルギッシュ。" />
            </picture>
          </div>
        </div>
      </section>

      <!-- パンくず -->
      <?php get_template_part('parts/breadcrumb'); ?>

      <!-- faq -->
      <?php
        // 'faq'はグループフィールドのスラッグ名
        $faq_items = SCF::get('faq');
        $has_valid_faq_items = false;

        // チェック: FAQ項目が空でないこと
        if (!empty($faq_items)) {
            foreach ($faq_items as $faq_item) {
                // 'faq-question'は質問のサブフィールドのスラッグ名
                $question = $faq_item['faq-question'];
                // 'faq-answer'は回答のサブフィールドのスラッグ名
                $answer = $faq_item['faq-answer'];

                // 質問または回答が空でない場合、$has_valid_faq_itemsをtrueに設定
                if (!empty($question) || !empty($answer)) {
                    $has_valid_faq_items = true;
                    break;
                }
            }
        }

        // 有効なFAQ項目がある場合にのみセクションを表示
        if ($has_valid_faq_items) :
        ?>
        <section class="faq sub-faq-spacing sub-layout">
            <div class="faq__inner inner">
                <ul class="faq__list faq-list">
                    <?php
                    foreach ($faq_items as $faq_item) {
                        // 'faq-question'は質問のサブフィールドのスラッグ名
                        $question = $faq_item['faq-question'];
                        // 'faq-answer'は回答のサブフィールドのスラッグ名
                        $answer = $faq_item['faq-answer'];

                        // 質問または回答が空でない場合にのみ表示
                        if (!empty($question) || !empty($answer)) {
                    ?>
                    <li class="faq-list__item">
                        <h2 class="faq-list__item-question js-faq-question"><?php echo esc_html($question); ?></h2>
                        <p class="faq-list__item-answer"><?php echo nl2br(esc_html($answer)); ?></p>
                    </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </section>
        <?php
        else :
        ?>
        <p class="no-posts__text no-posts__text--faq">投稿がありません。</p>
        <?php
        endif;
        ?>



<?php get_footer(); ?>