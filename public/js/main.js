$( document ).ready( function( $ ) {

    /**
     * Отправка номера телефона
     */
    $( '#form-phone-send' ).on( 'submit', function() {

        $.post(
            $(this).prop('action'),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "phone": $( '#phone' ).val()
            },
            function(data) {
                if (data.result == 'success') {
                    $('#form-wrap-phone').hide();
                    $('#form-wrap-key').show();
                }
                if (typeof (data.msg) == 'string') {
                    alert(data.msg);
                }
            },
            'json'
        );
        return false;
    } );


    /**
     * Отправка проверочного ключа
     */
    $( '#form-key-check' ).on( 'submit', function() {
        $(this).append();
        $.post(
            $(this).prop('action'),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "user_key": $( '#user_key' ).val(),
                "phone": $( '#phone' ).val()
            },
            function(data) {
                if (typeof (data.msg) == 'string') {
                    alert(data.msg);
                }
                if (typeof (data.redirect) == 'string') {
                    document.location.href = data.redirect;
                }
            },
            'json'
        );
        return false;
    } );

    /**
     * Отправка изменений в профиле
     */
    $( '#form-profile' ).on( 'submit', function() {

        $.post(
            $(this).prop('action'),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "age": $( '#age' ).val()
            },
            function(data) {
                if (typeof (data.msg) == 'string') {
                    alert(data.msg);
                }
            },
            'json'
        );
        return false;
    } );
    /**
     * Отправка проверочного со страницы списка пользователей
     */

    $( '.save-user-key').on( 'click', function() {
        userId = $(this).siblings('.user-id').val();
        key = $('#user-key-' + userId).val();
        $.post(
           '/users/saveKey',
            {
                "user_key": key,
                "user_id": userId,
                "_token": $('#csrf-token').val()
            },
            function(data) {
                if (typeof (data.msg) == 'string') {
                    alert(data.msg);
                }
            },
            'json'
        );
        return false;
    });


} );

