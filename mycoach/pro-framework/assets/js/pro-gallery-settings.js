// the semi-colon before the function invocation is a safety 
// net against concatenated scripts and/or other plugins 
// that are not closed properly.
// set root Object
;(function ( $, window, document, undefined ) {
  'use strict';
  $(document).ready( function(){
    var media = wp.media;
    // merge default gallery settings template
    media.view.Settings.Gallery = media.view.Settings.Gallery.extend({
      render: function() {
        var $el = this.$el;
        media.view.Settings.prototype.render.apply( this, arguments );
        // append pro gallery settings
        $el.append( media.template( 'pro-gallery-settings' ) );
        // set default attributes
        media.gallery.defaults.protype = '';
        media.gallery.defaults.scale  = '';
        media.gallery.defaults.size   = '';
        // apply update
        this.update.apply( this, ['protype'] );
        this.update.apply( this, ['scale'] );
        this.update.apply( this, ['size'] );
        // bind type
        $el.find( '#pro-gallery-type' ).on( 'change', function () {
          var hidden_settings = $el.find( '#pro-gallery-scale' );
          if ( 'slideshow' == $( this ).val() || 'gallery_thumb' == $( this ).val() || 'gallery_nearby' == $( this ).val() ){
            hidden_settings.removeClass('hidden');
          }else{
            hidden_settings.addClass('hidden');
          }
        } ).change();
        return this;
      }
    });
  });
})( jQuery, window, document );