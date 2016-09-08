jQuery(document).ready(function ($) {
    if ($('.mycoach_upload_button').length >= 1) {
        window.mycoach_uploadfield = '';
        $('.mycoach_upload_button').live('click', function () {
            window.mycoach_uploadfield = $('.upload_field', $(this).parent());
            tb_show('Upload', 'media-upload.php?type=image&TB_iframe=true', false);
            return false;
        });
        window.mycoach_send_to_editor_backup = window.send_to_editor;
        window.send_to_editor = function (html) {
            if (window.mycoach_uploadfield) {
                if ($('img', html).length >= 1) {
                    var image_url = $('img', html).attr('src');
                } else {
                    var image_url = $($(html)[0]).attr('href');
                }
                $(window.mycoach_uploadfield).val(image_url);
                window.mycoach_uploadfield = '';
                tb_remove();
            } else {
                window.mycoach_send_to_editor_backup(html);
            }
        }
    }
});