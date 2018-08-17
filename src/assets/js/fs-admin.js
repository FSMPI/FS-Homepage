jQuery(document).ready( function($){

    var mediaUploader;

    metaObject = {
        'poster' : {
            title: 'Wahlplakat auswählen',
            button: {
                text: 'Bild auswählen'
            },
            multiple: false
        }
    };

    $('input[name=uploadBtn]').on('click', function(e) {
       e.preventDefault();
       console.log("Button: '" + this.id + "' pressed");
       idName = this.id.split("-")[0];
       console.log(idName);

       if(mediaUploader) {
           mediaUploader.open();
           return;
       }

       mediaUploader = wp.media.frames.file_frame = wp.media(metaObject[idName]);

       mediaUploader.on('select', function(){
           attachment = mediaUploader.state().get('selection').first().toJSON();
           $('#'+idName+'-picture').val(attachment.url);
           $('#'+idName+'-picture-preview').css('background-image', 'url(' + attachment.url + ')');
           $('input[name=uploadBtn]').parents('form').find('input[type="submit"]').trigger('click');
       });

       mediaUploader.open();


    });

    $('input[name=removeBtn]').on('click', function(e) {
        e.preventDefault();
        console.log("Button: '" + this.id + "' pressed");
        idName = this.id.split("-")[0];
        console.log(idName);
        var answer = confirm("Möchtest du das Bild wirklich entfernen?");
        if(answer == true){
            $('#'+idName+'-picture').val('');
            //$('.fs-general-form').submit(); <-- Won´t work because of some DOM problems; Workaround below works
            $('input[name=removeBtn]').parents('form').find('input[type="submit"]').trigger('click');
        }
        return;
    });


    $('#addJobBtn').on('click', function(e) {
        e.preventDefault();
        job = $('#addJob').val();
        $('#jobsTable tr:last').before('<tr><td>'+job+'</td><td><input type="button" class="button button-warn" value="Entfernen" onclick="$(this).parents(\'tr\').first().remove()" id="deleteBtn-'+job+'" /></td><td><input type="hidden" name="jobs[]" value="'+job+'" /></td></tr>')
    });

    /*$('input[id^="deleteBtn-"]').on('click', function(e) {
       e.preventDefault();
       console.log($(e.srcElement).parents('tr').first().remove());
    });*/

    /*
    $('#poster-remove').on('click', function(e){
        e.preventDefault();
        $('#poster-picture').val('');
        $('.fs-general-form').submit();
    });
    */

    $('input[id^="uploadBtn-profile-"]').on('click',function(e) {
        //job = e.attr('id');
        job = $(this).attr('name');
        e.preventDefault();
        if( mediaUploader ){
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose a Profile Picture',
            button: {
                text: 'Choose Picture'
            },
            multiple: false
        });

        mediaUploader.on('select', function(){
            attachment = mediaUploader.state().get('selection').first().toJSON();
            console.log($('#profile-picture-'+job));
            $('#profile-picture-'+job).val(attachment.url);
            $('#profile-picture-preview-'+job).css('background-image','url(' + attachment.url + ')');
        });

        mediaUploader.open();

    });

    $('input[id^="removeBtn-profile-"]').on('click',function(e){
        job = $(this).attr('name');
        e.preventDefault();
        var answer = confirm("Are you sure you want to remove your Profile Picture?");
        if( answer == true ){
            $('#profile-picture-'+job).val('');
            $('#submit').trigger('click');
        }
        return;
    });


});
