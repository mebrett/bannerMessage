(function($) {
  $(document).ready(function() {
    var bannerText = 'This site contains historical content which may be upsetting or offensive to some visitors. Please see the content warning for a full statement.';
    var donationUrl = 'https://securemason.gmu.edu/s/1564/GID2/16/19-giving.aspx?sid=1564&gid=2&pgid=651&cid=1709&bledit=1&sort=1&dids=318.534.535.176.170&appealcode=IHM02';
    
    var buttonHtml = '<a href="' + donationUrl + '" class="donate-button"><img title="Donate to RRCHNM" src="https://rrchnm.org/donate/donate-button-red.svg"></a>';
    var bannerHtml = '<div id="content-warning-banner">' + bannerText + buttonHtml + '</div>';
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
