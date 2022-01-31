(function($) {
  $(document).ready(function() {
    var bannerText = 'This site contains historical content which may be upsetting or offensive to some visitors. Please see the <a href="https://hearingtheamericas.org/s/the-americas/page/content"> content notice </a> for a full statement.';
    
    var bannerHtml = '<div id="content-warning-banner">' + bannerText + '</div>';
    var banner = $(bannerHtml);
    
    if ($('body').hasClass('admin-bar')) {
      $('#admin-bar').after(banner);
    } else if ($('#user-bar').length > 0) {
      $('#user-bar').after(banner);      
    } else {
      $('body').prepend(banner);      
    }
  });
})(jQuery);
