// the semi-colon before the function invocation is a safety 
// net against concatenated scripts and/or other plugins 
// that are not closed properly.
// set root Object
;(function ( $, window, document, undefined ) {
  'use strict';
  // ======================================================
  if ( !$.PROWP ) {
    $.PROWP = {};
  }
  // ======================================================
  // ======================================================
  // PROWP MEGA MENU
  // ======================================================
  $.PROWP.megamenu = function( el ){
    var base  = this;
    // Access to jQuery and DOM versions of element
    base.$el  = $(el);
    base.el   = el;
    // Add a reverse reference to the DOM object
    base.$el.data( "PROWP.megamenu" , base );
    base.init = function () {
      var _timeout  = 0,
          _menu     = base.$el;
      _menu.on('click', '.is-mega', function(){
        base.flush( $(this) );
        base.depends( _menu );
      });
      _menu.on( 'mouseup', '.menu-item-bar', function(){
        clearTimeout( _timeout );
        _timeout = setTimeout( function(){ base.depends(); }, 50 );
      });
      _menu.on('change', '.is-width', function(){
        var _this       = $(this),
            _container  = _this.closest('.pro-mega-menu');
        if( _this.val() == 'custom' || _this.val() == 'natural' ) {
          _container.find('.mega-depend-position').removeClass('hidden');
        } else {
          _container.find('.mega-depend-position').addClass('hidden');
        }
        if( _this.val() == 'custom' ) {
          _container.find('.mega-depend-width').removeClass('hidden');
        } else {
          _container.find('.mega-depend-width').addClass('hidden');
        }
      });
      $('.is-width').trigger('change');
      base.depends();
    };
    base.depends = function(){
      var _menu = base.$el;
      _menu.find('.is-mega').each(function (){
        base.flush( $(this) );
      });
      // clear all mega columns
      $('li', _menu).removeClass('active-mega-column').removeClass('active-sub-mega-column');
      // add columns for mega menu
      var nextDepth = $('.active-mega-menu', _menu).nextUntil('.menu-item-depth-0', 'li');
      nextDepth.closest('li.menu-item-depth-1').addClass('active-mega-column');
      nextDepth.closest('li:not(.menu-item-depth-1)').addClass('active-sub-mega-column');
    };
    base.flush = function( _el ){
      if( _el.is(':checked') ){
        _el.closest('li').addClass('active-mega-menu');
        _el.closest('li').find('.field-mega-width').removeClass('hidden');
      }else{
        _el.closest('li').find('.field-mega-width').addClass('hidden');
        _el.closest('li').removeClass('active-mega-menu');
      }
    };
    // Run initializer
    base.init();
  };
  $.fn.PROWP_megamenu = function () {
    return this.each(function () {
      new $.PROWP.megamenu( this );
    });
  };
	
	// ======================================================
	
  // ======================================================
  // PROWP ICON SELECTOR
  // ======================================================
  $.fn.PROWP_icon = function() {
    var _iconDialog   = $('#icon-dialog'),
        _iconOverlay  = $('#icon-overlay'),
        _iconInsert   = _iconDialog.find('#icon-insert'),
        _iconLoad     = _iconDialog.find('#icon-load'),
        _iconSearch   = _iconDialog.find('#icon-search'),
        _iconSelected = false,
        _iconsLoaded  = false,
        _iconRemove,
        _iconParent,
        _iconValue,
        _iconDialogHeight,
        _iconPreview;
    $(document.body).on('click', '.icon-add', function( e ){
      e.preventDefault();
      // set vars
      _iconDialogHeight = ( $(window).height() <= 700 ) ? 500 : 700;
      _iconParent       = $(this).parent();
      _iconPreview      = _iconParent.find('.icon-preview');
      _iconRemove       = _iconParent.find('.icon-remove');
      _iconValue        = _iconParent.find('.icon-value');
      _iconDialog.dialog({
        dialogClass: 'wp-dialog pro-icon-dialog',
        width: 1000,
        height: _iconDialogHeight,
        closeOnEscape: true,
        create: function(){
          $('.ui-dialog-titlebar-close').addClass('ui-button');
        },
        open: function() {
          _iconLoad.height( parseInt( _iconDialogHeight - 210 ) );
          _iconOverlay.show();
        },
        close: function() {
          _iconOverlay.hide();
        },
        resize: function( event, ui ) {
          _iconLoad.height( parseInt( ui.size.height - 210 ) );
        }
      });
      if( _iconsLoaded === false ){
        $.get( ajaxurl + '?action=pro-icons').done(function( data ) {
          _iconLoad.html( data );
          _iconLoad.find('a').each( function(){
            var _this = $(this),
                _data = _this.data('icon');
            _this.click( function( e ){
              e.preventDefault();
              if( _this.is('.active-icon') ){
                _this.removeClass('active-icon');
                _iconSelected = false;
              }else{
                _this.addClass('active-icon').siblings().removeClass('active-icon');
                _iconSelected = _data;
              }
            });
          });
          _iconsLoaded = true;
        });
      }
      _iconSearch.keyup( function(){
        var input = $(this),
            val   = input.val(),
            list  = _iconLoad.find('a');
        list.each(function() {
          var _this = $(this);
          if ( _this.data('icon').search( new RegExp(val, "i") ) < 0 ) {
            _this.hide();
          } else {
            _this.show();
          }
        });
      });
      _iconInsert.click( function( e ) {
        e.preventDefault();
        if ( _iconSelected !== false ){
          // preview
          _iconPreview.removeClass('hidden');
          _iconPreview.find('span').removeAttr('class').addClass( _iconSelected.substr( 0,2 ) + ' ' + _iconSelected );
          // value
          _iconValue.val( _iconSelected ).trigger('keyup');
          // remove icon class
          _iconRemove.removeClass('hidden');
          // close dialog
          _iconDialog.dialog( 'close' );
        }
      });
    });
    // clear
    $(document.body).on('click', '.icon-remove', function(e){
      e.preventDefault();
      var _remove = $(this),
        _parent = _remove.parent();
      _parent.find('.icon-preview').addClass('hidden');
      _parent.find('.icon-value').val('');
      _remove.addClass('hidden');
    });
    _iconOverlay.click( function( e ) {
      e.preventDefault();
      _iconOverlay.hide();
      _iconDialog.dialog( 'close' );
    });
  };
  // ======================================================
  /* 
    // ======================================================
  // PROWP SHORTCODE MANAGER
  // ======================================================
  $.PROWP.shortcodeManager = function( el ){
    var base  = this;
    // Access to jQuery and DOM versions of element
    base.$el  = $(el);
    base.el   = el;
    base.win  = $(window);
    // Add a reverse reference to the DOM object
    base.$el.data( "PROWP.shortcodeManager" , base );
    base.init = function () {
      var shortcodeOverlay  = $('#shortcode-overlay'),
        shortcodeDialog     = $('#shortcode-dialog'),
        shortcodeInsert     = shortcodeDialog.find('#shortcode-insert'),
        shortcodeLoad       = shortcodeDialog.find('#shortcode-load'),
        shortcodeSelector   = shortcodeDialog.find('#shortcode-select'),
        dialog_height       = ( $(window).height() <= 700 ) ? 500 : 700,
        shortcode_name,
        shortcode_view,
        shortcode_clone,
        shortcode_target;
      $(document.body).on('click', '.shortcode-button', function( e ){
        e.preventDefault();
        var _this = $(this),
          _target = _this.data('target');
        shortcode_target = _target;
        // init jquery ui-dialog
        shortcodeDialog.dialog({
          dialogClass: 'wp-dialog cs-shortcode-dialog',
          width: 850,
          height: dialog_height,
          closeOnEscape: true,
          create: function(){
            $('.ui-dialog-titlebar-close').addClass('ui-button');
          },
          open: function() {
            shortcodeLoad.height( parseInt(dialog_height - 195) );
            shortcodeOverlay.show();
          },
          close: function() {
            shortcode_target = undefined;
            shortcodeOverlay.hide();
          },
          resize: function( event, ui ) {
            shortcodeLoad.height( parseInt(ui.size.height - 195) );
          }
        });
      });
      shortcodeOverlay.click( function( e ) {
        e.preventDefault();
        shortcodeOverlay.hide();
        shortcodeDialog.dialog( 'close' );
      });
      shortcodeSelector.on( 'change', function() {
        var elem_this   = $(this);
        shortcode_name  = elem_this.val();
        shortcode_view  = elem_this.find(':selected').data('view');
        // check val
        if( shortcode_name.length ){
          $.ajax({
            type  : 'POST',
            url   : ajaxurl,
            data  : { action: 'get-shortcode', shortcode: shortcode_name },
            success : function( content ) {
              shortcodeLoad.html( content );
              shortcodeInsert.parent().removeClass('hidden');
              shortcode_clone = $('.shortcode-clone', shortcodeDialog).clone();
              // reloadPlugins
              shortcodeLoad.PROWP_dependency();
              shortcodeLoad.PROWP_dependency('sub');
              $.reloadPlugins();
            }
          });
        }else{
          shortcodeInsert.parent().addClass('hidden');
          shortcodeLoad.html('');
        }
      });
      shortcodeInsert.click( function(e){
        e.preventDefault();
        // set variables
        var send_to_shortcode = '', ruleAttr = 'data-atts', cloneAttr = 'data-clone-atts', cloneID = 'data-clone-id';
        switch ( shortcode_view ){
          case 'normal':
          case 'single':
            send_to_shortcode += '[' + shortcode_name;
            $('[' + ruleAttr + ']', '#shortcode-load .pro-element-wrap:not(.hidden)').each( function(){
              var _this = $(this), _atts = _this.data('atts');
              // is not attr content, add shortcode attribute else write content and close shortcode tag
              if( _atts != 'content' ){
                send_to_shortcode += base.validate_atts( _atts, _this ); // validate empty atts
              }else if ( _atts == 'content' ){
                send_to_shortcode += ']';
                send_to_shortcode += _this.val(); 
                send_to_shortcode += '[/'+shortcode_name+'';
              }
            });
            send_to_shortcode += ']';
          
          break;
          case 'contents':
            $('[' + ruleAttr + ']', '#shortcode-load').each( function(){
              var _this = $(this), _atts = _this.data('atts');
              send_to_shortcode += '['+_atts+']';
              send_to_shortcode += _this.val();
              send_to_shortcode += '[/'+_atts+']';
            });
          break;
          case 'flexible':
            // main-shortcode begin
            send_to_shortcode += '[' + shortcode_name;
            // main-shortcode attributes begin
            $('[' + ruleAttr + ']', '#shortcode-load .pro-element-wrap:not(.hidden)').each( function(){
              var _this_main = $(this), _this_main_atts = _this_main.data('atts');
              send_to_shortcode += base.validate_atts( _this_main_atts, _this_main );  // validate empty atts
            });
            send_to_shortcode += ']';
            // main-shortcode attributes end
            
            // multiple-shortcode each begin
            $('[' + cloneID + ']', '#shortcode-load').each( function(){
                // multiple-shortcode begin
                var _this_clone = $(this), _clone_id = _this_clone.data('clone-id');
                send_to_shortcode += '[' + _clone_id;
                // multiple-shortcode attributes begin
                $('[' + cloneAttr + ']', _this_clone.find('.pro-element-wrap').not('.hidden') ).each( function(){
                  var _this_multiple = $(this), _atts_multiple = _this_multiple.data('clone-atts');
                  
                  // is not attr content, add shortcode attribute else write content and close shortcode tag
                  if( _atts_multiple != 'content' ){
                    send_to_shortcode += base.validate_atts( _atts_multiple, _this_multiple ); // validate empty atts
                  }else if ( _atts_multiple == 'content' ){
                    send_to_shortcode += ']';
                    send_to_shortcode += _this_multiple.val(); 
                    send_to_shortcode += '[/'+_clone_id+'';
                  }
                });
                // multiple-shortcode attributes end
                send_to_shortcode += ']';
                // multiple-shortcode end
            });
            // multiple-shortcode each end
            send_to_shortcode += '[/' + shortcode_name + ']';
            // main-shortcode end
          break;
        }
        if( shortcode_target !== undefined ){
          var textarea_target = $('#' + shortcode_target);
          textarea_target.val( base.insertAtChars( textarea_target, send_to_shortcode ) );
        }else{
          window.send_to_editor( send_to_shortcode );
        }
        shortcodeDialog.dialog( 'close' );
      });
      // cloner button
      var i = 0;
      shortcodeDialog.on('click', '#shortcode-clone', function( e ){
        e.preventDefault();
        // clone from cache
        var cloned_el = shortcode_clone.clone().hide();
          cloned_el.find('input:radio').attr('name', '_nonce_' + i);
        $('.shortcode-clone:last').after( cloned_el );
        // add - remove effects
        cloned_el.slideDown(100);
        cloned_el.find('.remove-clone').show().click( function( e ){
          cloned_el.slideUp(100, function(){ cloned_el.remove(); });
          e.preventDefault();
        });
        // reloadPlugins
        cloned_el.PROWP_dependency('sub');
        $.reloadPlugins();
        i++;
      });
    };
    base.validate_atts = function(  _atts, _this ) {
      var el_value;
      if ( _this.closest('.pseudo-field').hasClass('hidden') === true ){ return ''; }
      if ( _this.hasClass('pseudo') === true ){ return ''; }
      if( _this.is(':checkbox') || _this.is(':radio') ){
        el_value = _this.is(':checked') ? _this.val() : '';
      }else{
        el_value = _this.val();
      }
      // return if valid
      if( el_value !== null && el_value !== undefined && el_value !== '' ){
        return ' ' + _atts + '="' + el_value + '"';
      }
      return '';
    };
    base.insertAtChars = function( _this, currentValue ){
      var obj = ( typeof _this[0].name !='undefined' ) ? _this[0] : _this;
      if ( $.browser.mozilla || $.browser.webkit ) {
        obj.focus();
        return obj.value.substring( 0, obj.selectionStart ) + currentValue + obj.value.substring( obj.selectionEnd, obj.value.length );
      } else {
        obj.focus();
        return currentValue;
      }
    };
    // Run initializer
    base.init();
  };
  // ======================================================
  */
  
  // ======================================================
  // PROWP MEDIA UPLOADER / UPLOAD
  // ======================================================
  $.fn.PROWP_upload = function() {
    return this.each(function() {
      // extending default settings
      var el          = $(this),
        media_upload  = el.find('.pro-add-media'),
        media_remove  = el.find('.pro-button-remove'),
        media_preview = el.find('.pro-upload-preview'),
        send_val      = el.find('input.media-attachment'),
        send_detail   = el.find('input.media-details'),
        media_thumbnail,
        frame;
      media_upload.click( function( event ) {
        event.preventDefault();
        // Check if the `wp.media.gallery` API exists.
        if ( typeof wp === 'undefined' || ! wp.media || ! wp.media.gallery ){
          return;
        }
        // If the media frame already exists, reopen it.
        if ( frame ) {
          frame.open();
          return;
        }
        // Create the media frame.
        frame = wp.media.frames.customUpload = wp.media({
          
          // Set the title of the modal.
          title: media_upload.data('frame-title'),
          // Tell the modal to show only images.
          library: {
            type: media_upload.data('upload-type')
          },
          // Customize the submit button.
          button: {
            // Set the text of the button.
            text: media_upload.data('insert-title'),
          }
        });
        // When an image is selected, run a callback.
        frame.on( 'select', function() {
          // Grab the selected attachment.
          var attachment = frame.state().get('selection').first(), return_method = media_upload.data('return');
          send_val.val( attachment.attributes[return_method] ).trigger('keyup');
          if ( send_detail.length ) {
            send_detail.val( attachment.attributes.id + ',' + attachment.attributes.width + ',' + attachment.attributes.height );
          }
          if ( media_preview.length ) {
            media_thumbnail = ( attachment.attributes.sizes !== undefined && attachment.attributes.sizes.thumbnail !== undefined ) ? attachment.attributes.sizes.thumbnail.url : attachment.attributes.url;
            media_preview.html( '<a href="'+ attachment.attributes.url +'" target="_blank"><img src="'+ media_thumbnail +'" alt=""/></a>' );
            media_remove.removeClass('hidden');
          }
        });
        // Finally, open the modal.
        frame.open();
        
      });
      media_remove.click( function( event ) {
        event.preventDefault();
        send_val.val('');
        if ( media_preview.length ) {
          media_preview.html('');
          media_remove.addClass('hidden');
        }
        if ( send_detail.length ) {
          send_detail.val('');
        }
      });
    });
 
  };
  // ======================================================
  // ======================================================
  // VISUAL COMPOSER IMAGE SELECT
  // ======================================================
  $.fn.JSCOMPOSER_image_select = function() {
    return this.each(function() {
      var _el       = $(this),
          _elems    = _el.find('li');
      _elems.each( function (){
        var _this = $(this),
            _data = _this.data('value');
        _this.click( function(){
          if( _this.is('.selected') ){
            _this.removeClass('selected');
            _el.next().val('').trigger('keyup');
          }else{
            _this.addClass('selected').siblings().removeClass('selected');
            _el.next().val( _data ).trigger('keyup');
          }
        });
      });
    });
  };
  // ======================================================
  // ======================================================
  // VISUAL COMPOSER SWITCH
  // ======================================================
  $.fn.JSCOMPOSER_switch = function() {
    return this.each(function() {
      var _this   = $(this),
          _input  = _this.find('input');
      _this.click( function(){
        _this.toggleClass('switch-active');
        _input.val( ( _input.val() == 1 ) ? '' : 1 ).trigger('keyup');
      });
    });
  };
  // ======================================================
  // RELOAD JSCOMPOSER PLUGINS
  // ======================================================
  $.reloadJSPlugins = function() {
    $('.vc_switch').JSCOMPOSER_switch();
    $('.vc_image_select').JSCOMPOSER_image_select();
    $('.pro-color-picker').wpColorPicker({ palettes:["#000000", "#ffffff",  "#6e6e6e", "#428bca", "#5cb85c", "#d9534f", "#f0ad4e"]});
    $('.pro-uploader').PROWP_upload();
    $('.chosen').chosen({allow_single_deselect: true, disable_search_threshold: 15});
  };
  // ======================================================
// ======================================================
// RELOAD FRAMEWORK PLUGINS
// ======================================================
	$.reloadPlugins = function() {
		$('.pro-icon-select').PROWP_icon();
	};
	$(document).ready( function(){
		console.time('backend-time');
		$('#menu-to-edit').PROWP_megamenu();
		$('.pro-icon-select').PROWP_icon();
		//$.reloadPlugins
		//$.PROWP.shortcodeManager(); 
		console.timeEnd('backend-time');
	
	});
})( jQuery, window, document );