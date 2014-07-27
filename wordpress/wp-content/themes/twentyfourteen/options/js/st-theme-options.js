/**
 * 
 * Stylish Templates Theme Options Javascript
 * 
 */

jQuery(document).ready(function() {
  
  jQuery('.settingsBox .settings').hide();
  
  jQuery('.setHead').click(function() {
    jQuery(this).siblings('.settings').toggle();
    if(jQuery('#useslider').attr('checked')){
      jQuery(this).siblings('.sliderboxes').children('.settings').toggle()
    };
    if(jQuery('#useteaser').attr('checked')){
      jQuery(this).siblings('.teaserboxes').children('.settings').toggle()
    };
  });

  jQuery('#useteaser').click(function() {
    jQuery('.teaserboxes').children('.settings').toggle()
  });
  
  jQuery('#useslider').click(function() {
    jQuery('.sliderboxes').children('.settings').toggle()
    jQuery('#headerimg').hide();
  });
  
  jQuery('#st-info .settings').show();
  jQuery('#st-info .setHead').click(function() { });
         
});