    <footer role="contentinfo">
        <div class="container">
            <div id="footer-text">
                <?php echo get_theme_option('Footer Text'); ?>
                <div>
                    <a target="_blank" href="http://kuleuven.be"><img height="60px" src="<?php echo img("KULEUVEN.png");?>"></a>
                    <a target="_blank" href="http://www.fondsbailletlatour.com/index.cfm?lang=NED&pageID=14"><img height="120px" src="<?php echo img("Logo_baillet.png");?>"></a>
                    <a target="_blank" href="https://en.unesco.org/programme/mow"><img height="125px" src="<?php echo img("memory_world.png");?>"></a>
                </div>
                <div>
                    <a target="_blank" href="https://theo.kuleuven.be/apps/press/bookheritagelab/about/"><img height="60px" src="<?php echo img("TitleBHL.png");?>"></a>
                    <a target="_blank" href="http://www.illuminare.be/"><img height="80px" src="<?php echo img("illuminare.png");?>"></a>
                    <a target="_blank" href="https://libis.be"><img height="60px" src="<?php echo img("libis_gray.png");?>"></a>
                </div>
                <div class="footer-brand">
                  <div class="footer-content">
                    <!--<p><a class="footer-logo" href="<?php echo url("/");?>">digital<span>Husserl</span></a> Straatstraat 22 | 3000 Leuven | +3216222222</p>-->
                    <ul>
                        <li><a href="">Cookie policy</a></li>
                    </ul>
                  </div>
                </div>
                <div class="copyright">
                  © KU Leuven
                </div>
            </div>
            <?php fire_plugin_hook('public_footer', array('view' => $this)); ?>
        </div>
    </footer><!-- end footer -->
</body>
<script>
jQuery(".toggle").on("click", function() {
  jQuery(".modal").toggleClass('active');
});
jQuery(".search-toggle").on("click", function() {
  jQuery(".modal-search").toggleClass('active');
});
jQuery(document).ready(function() {


  jQuery('a[href^="#"]').on('click',function (e) {
      e.preventDefault();

      var target = this.hash,
      $target = jQuery(target);

      jQuery('html, body').stop().animate({
          'scrollTop': $target.offset().top
      }, 900, 'swing', function () {
          window.location.hash = target;
      });
  });

  jQuery('button.close').click(function() {
    jQuery('#page-slide').toggleClass('slide');
  });

  jQuery('button#toggle').click(function() {
    jQuery('#page-slide').toggleClass('slide');
    jQuery('#toggle').toggleClass('slide-tog');
  });

  jQuery('#lang-switcher').find('.ui-dropdown-list-trigger').each(function() {
    jQuery(this).click(function(){
      jQuery(this).parent().toggleClass('active');
    });

  });
});

</script>
</html>
