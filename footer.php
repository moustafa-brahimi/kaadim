
    <div class="modal-searchform" id="modal-searchform">
      
      <?php get_search_form(); ?>

      <?php $token = "IGQVJWSWxpbzg4aE01QXFrTHhaQnpWWW9HaDZAqa2VlRE5yQjZAqM29rdi1BbnFIenVXSXh1UEJMSzdCOExpdlY0RDRjejhQRzlnZAmxnclFpcWZAVVEg2ZAFNFQ1B6OEpIR3RONUFpUjZAR"; ?>
      
      <?php

      function request($path) {
        return json_decode(file_get_contents($path), true); 
      }

      $url = "https://api.instagram.com/oauth/access_token";
      $header = 0;

      $feed = request( sprintf( "https://graph.instagram.com/me/media?fields=username,permalink,timestamp,caption,media_url&access_token=%s", $token ) );


      ?>



      <button type="button" class="modal-searchform__collapse js-btn-collapse-searchform">

        <i class="fa-solid fa-xmark fa-lg"></i>

      </button>

    </div>

    <footer>

      <div class="instagram-grid">
          
        <?php foreach( $feed["data"] as $key => $element ): ?>

          <img src="<?php print( $element["media_url"] ); ?>" />

        <?php endforeach; ?>


      </div>


      <i class="octo octo-instagram-icon" size="500"></i>


    </footer>

  </body>

  <?php wp_footer(); ?>

</html>