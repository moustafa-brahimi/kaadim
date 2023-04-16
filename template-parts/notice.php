<?php if( get_theme_mod( 'kadim_notice_status' ) && !( isset($_COOKIE["collapsed"]) && is_true($_COOKIE["collapsed"]) ) ): ?>

  <div class="notice" id="notice">

    <i class="notice__bell fa-solid fa-bell"></i>

    <p class="notice__content">
      <?php echo get_theme_mod( "kadim_notice_content", __( 'Lorem Ipsum is simply dummy text of the printing and typesetting', 'kadim' ) ); ?>
    </p>

    <button class="notice__close btn-close-notice" title="<?php esc_attr_e( "Collapse the notice", "kadim" ); ?>">

      <i class="icon fa-solid fa-xmark"></i>

    </button>

  </div>

<?php endif; ?>
