      <div class="breadcrumb sub-breadcrumb-spacing<?php if (is_404()) echo ' breadcrumb--not-found'; ?>">
        <div class="breadcrumb__inner inner">
        <?php if (function_exists('bcn_display')) {
          ob_start();
          bcn_display();
          $breadcrumb = ob_get_clean();
          echo wp_kses_post($breadcrumb);
        }?>
        </div>
      </div>