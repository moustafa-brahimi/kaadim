
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

      <!-- <canvas id="" width="500" height="500"></canvas> -->

      <i id="instagram-icon" size="500"></i>

      <!--

      <svg xmlns="http://www.w3.org/2000/svg" width="500" height="499.888" viewBox="0 0 500 499.888">

        <clipPath id="instagram-outer">
          <path id="instagram" d="M498.168,178.7c-1.9-40.045-11.043-75.516-40.379-104.741-29.225-29.225-64.7-38.371-104.741-40.379-41.272-2.342-164.975-2.342-206.247,0-39.933,1.9-75.4,11.043-104.741,40.268S3.69,138.546,1.682,178.59c-2.342,41.272-2.342,164.975,0,206.247,1.9,40.045,11.043,75.516,40.379,104.741s64.7,38.371,104.741,40.379c41.272,2.342,164.975,2.342,206.247,0,40.045-1.9,75.516-11.043,104.741-40.379,29.225-29.225,38.371-64.7,40.379-104.741,2.342-41.272,2.342-164.863,0-206.135ZM444.85,429.12a84.359,84.359,0,0,1-47.518,47.518c-32.906,13.051-110.987,10.039-147.351,10.039s-114.557,2.9-147.351-10.039A84.359,84.359,0,0,1,55.112,429.12C42.061,396.214,45.073,318.133,45.073,281.769s-2.9-114.557,10.039-147.351A84.359,84.359,0,0,1,102.63,86.9C135.536,73.85,213.617,76.861,249.981,76.861s114.557-2.9,147.351,10.039a84.359,84.359,0,0,1,47.518,47.518c13.051,32.906,10.039,110.987,10.039,147.351S457.9,396.326,444.85,429.12Z" transform="translate(0.075 -31.825)"/>
        </clipPath>
      
      </svg>

      -->



    </footer>

  </body>

  <?php wp_footer(); ?>

</html>