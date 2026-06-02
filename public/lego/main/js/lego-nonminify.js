$(document).ready(function() {
    Loading(2);
    $('#SearchForm').submit(function (e) {
        e.preventDefault();
        let  searchtag = $('.searchInput').val();
        $(window).attr('location', $(this).data('action')+'/'+searchtag+'/1');
    });

    $('#SearchForm2').submit(function (e) {
        e.preventDefault();
        let  searchtag = $('.searchInput2').val();
        $(window).attr('location', $(this).data('action')+'/'+searchtag+'/1');
    });

    $(".CustomFormSubmit").on('submit',function(e)
    {
        Loading(1);
        e.preventDefault();
        let isFormValid = $('.CustomFormSubmit')[0].checkValidity();
        if(!isFormValid) {
            grecaptcha.reset();
            Swal.fire({
                allowOutsideClick : false,
                allowEscapeKey : false,
                title: '',
                text: document.getElementsByName('validate_message')[0].value,
                showCancelButton: true,
                showConfirmButton:false,
                cancelButtonText: 'Ok',
                icon: 'warning',
            });
        } else {
            $.ajax({
                type: this.method,
                url: this.action,
                data: new FormData(this),
                processData: false,
                contentType: false,
                success : function (response)
                {
                    if (response.status == true){
                        Loading(2);
                        Swal.fire({
                            allowOutsideClick : false,
                            allowEscapeKey : false,
                            title: response.message,
                            icon: 'success',
                            showCancelButton: true,
                            cancelButtonText: document.getElementsByName('close_button_text')[0].value,
                            showConfirmButton:false
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.cancel)
                            {
                                // location.reload();
                            }
                        });
                    }else{
                        grecaptcha.reset();
                        Swal.fire({
                            allowOutsideClick : false,
                            allowEscapeKey : false,
                            title: response.title,
                            text: response.message,
                            showCancelButton: true,
                            showConfirmButton:false,
                            cancelButtonText: response.extra,
                            icon: 'warning',
                        });
                    }
                },
                error: function(response) {
                    grecaptcha.reset();
                    let error      = '';
                    if (response.responseJSON)
                    {
                        let error_json = response.responseJSON;
                        for(var k in error_json)
                        {
                            for (var a in error_json[k])
                            {
                                error += error_json[k][a];
                            }
                        }
                    }else { error = response.responseText;
                        grecaptcha.reset();
                    }
                    Swal.fire({
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        title: 'Oops...',
                        text: error,
                        icon: 'error',
                    });

                }
            });
        }

    });

    $(".OfferFormSubmit").on('submit',function(e)
    {
        Loading(1);
        e.preventDefault();
        let isFormValid = $('.OfferFormSubmit')[0].checkValidity();
        if(!isFormValid) {
            grecaptcha.reset();
            Swal.fire({
                allowOutsideClick : false,
                allowEscapeKey : false,
                title: '',
                text: document.getElementsByName('validate_message')[0].value,
                showCancelButton: true,
                showConfirmButton:false,
                cancelButtonText: 'Ok',
                icon: 'warning',
            });
        } else {
            $.ajax({
                type: this.method,
                url: this.action,
                data: new FormData(this),
                processData: false,
                contentType: false,
                success : function (response)
                {
                    if (response.status == true){
                        Loading(2);
                        Swal.fire({
                            allowOutsideClick : false,
                            allowEscapeKey : false,
                            title: response.message,
                            icon: 'success',
                            showCancelButton: true,
                            cancelButtonText: document.getElementsByName('close_button_text')[0].value,
                            showConfirmButton:false
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.cancel)
                            {
                                // location.reload();
                            }
                        });
                    }else{
                        grecaptcha.reset();
                        Swal.fire({
                            allowOutsideClick : false,
                            allowEscapeKey : false,
                            title: response.title,
                            text: response.message,
                            showCancelButton: true,
                            showConfirmButton:false,
                            cancelButtonText: response.extra,
                            icon: 'warning',
                        });
                    }
                },
                error: function(response) {
                    grecaptcha.reset();
                    let error      = '';
                    if (response.responseJSON)
                    {
                        let error_json = response.responseJSON;
                        for(var k in error_json)
                        {
                            for (var a in error_json[k])
                            {
                                error += error_json[k][a];
                            }
                        }
                    }else { error = response.responseText;
                        grecaptcha.reset();
                    }
                    Swal.fire({
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        title: 'Oops...',
                        text: error,
                        icon: 'error',
                    });

                }
            });
        }

    });

    $('.SubmitForm').submit( function (e)
    {
        Loading(1);
        e.preventDefault();
        $.ajax({
            type: this.method,
            url: this.action,
            data:  $(this).serialize(),
            success : function (response)
            {
                if (response.status == true){
                    Loading(2);
                    Swal.fire({
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        title: response.message,
                        icon: 'success',
                        showCancelButton: true,
                        cancelButtonText: document.getElementsByName('close_button_text')[0].value,
                        showConfirmButton:false
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel)
                        {
                            // location.reload();
                        }
                    });
                }else{
                    grecaptcha.reset();
                    Swal.fire({
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        title: response.title,
                        text: response.message,
                        showCancelButton: true,
                        showConfirmButton:false,
                        cancelButtonText: response.extra,
                        icon: 'warning',
                    });
                }
            },
            error: function(response) {
                grecaptcha.reset();
                let error      = '';
                if (response.responseJSON)
                {
                    let error_json = response.responseJSON;
                    for(var k in error_json)
                    {
                        for (var a in error_json[k])
                        {
                            error += error_json[k][a];
                        }
                    }
                }else { error = response.responseText;
                    grecaptcha.reset();
                }
                Swal.fire({
                    allowOutsideClick : false,
                    allowEscapeKey : false,
                    title: 'Oops...',
                    text: error,
                    icon: 'error',
                });

            }
        });
    });

    $('.SubmitForm2').submit( function (e)
    {
        Loading(1);
        e.preventDefault();
        $.ajax({
            type: this.method,
            url: this.action,
            data:  $(this).serialize(),
            success : function (response)
            {
                if (response.status == true){
                    Loading(2);
                    Swal.fire({
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        title: response.message,
                        icon: 'success',
                        showCancelButton: true,
                        cancelButtonText: document.getElementsByName('close_button_text')[0].value,
                        showConfirmButton:false
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel)
                        {
                            // location.reload();
                        }
                    });
                }else{
                    grecaptcha.reset();
                    Swal.fire({
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        title: response.title,
                        text: response.message,
                        showCancelButton: true,
                        showConfirmButton:false,
                        cancelButtonText: response.extra,
                        icon: 'warning',
                    });
                }
            },
            error: function(response) {
                grecaptcha.reset();
                let error      = '';
                if (response.responseJSON)
                {
                    let error_json = response.responseJSON;
                    for(var k in error_json)
                    {
                        for (var a in error_json[k])
                        {
                            error += error_json[k][a];
                        }
                    }
                }else { error = response.responseText;
                    grecaptcha.reset();
                }
                Swal.fire({
                    allowOutsideClick : false,
                    allowEscapeKey : false,
                    title: 'Oops...',
                    text: error,
                    icon: 'error',
                });

            }
        });
    });

    $('.SubmitForm3').submit( function (e)
    {
        Loading(1);
        e.preventDefault();
        $.ajax({
            type: this.method,
            url: this.action,
            data:  $(this).serialize(),
            success : function (response)
            {
                if (response.status == true){
                    Loading(2);
                    Swal.fire({
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        title: response.message,
                        icon: 'success',
                        showCancelButton: true,
                        cancelButtonText: document.getElementsByName('close_button_text')[0].value,
                        showConfirmButton:false
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel)
                        {
                            // location.reload();
                        }
                    });
                }else{
                    grecaptcha.reset();
                    Swal.fire({
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        title: response.title,
                        text: response.message,
                        showCancelButton: true,
                        showConfirmButton:false,
                        cancelButtonText: response.extra,
                        icon: 'warning',
                    });
                }
            },
            error: function(response) {
                grecaptcha.reset();
                let error      = '';
                if (response.responseJSON)
                {
                    let error_json = response.responseJSON;
                    for(var k in error_json)
                    {
                        for (var a in error_json[k])
                        {
                            error += error_json[k][a];
                        }
                    }
                }else { error = response.responseText;
                    grecaptcha.reset();
                }
                Swal.fire({
                    allowOutsideClick : false,
                    allowEscapeKey : false,
                    title: 'Oops...',
                    text: error,
                    icon: 'error',
                });

            }
        });
    });

    $('.SubmitForm4').submit( function (e)
    {
        Loading(1);
        e.preventDefault();
        $.ajax({
            type: this.method,
            url: this.action,
            data:  $(this).serialize(),
            success : function (response)
            {
                if (response.status == true){
                    Loading(2);
                    Swal.fire({
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        title: response.message,
                        icon: 'success',
                        showCancelButton: true,
                        cancelButtonText: document.getElementsByName('close_button_text')[0].value,
                        showConfirmButton:false
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel)
                        {
                            // location.reload();
                        }
                    });
                }else{
                    grecaptcha.reset();
                    Swal.fire({
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        title: response.title,
                        text: response.message,
                        showCancelButton: true,
                        showConfirmButton:false,
                        cancelButtonText: response.extra,
                        icon: 'warning',
                    });
                }
            },
            error: function(response) {
                grecaptcha.reset();
                let error      = '';
                if (response.responseJSON)
                {
                    let error_json = response.responseJSON;
                    for(var k in error_json)
                    {
                        for (var a in error_json[k])
                        {
                            error += error_json[k][a];
                        }
                    }
                }else { error = response.responseText;
                    grecaptcha.reset();
                }
                Swal.fire({
                    allowOutsideClick : false,
                    allowEscapeKey : false,
                    title: 'Oops...',
                    text: error,
                    icon: 'error',
                });

            }
        });
    });


    $('.cartPush').submit( function (e)
    {

        Loading(1);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: this.action,
            data: $(this).serialize(),
            success: function(response) {
                let timerInterval;
                Swal.fire({
                    icon: 'success',
                    title: document.getElementById('successMessage').value,
                    showDenyButton: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {

                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.reload();
                    }

                });

            }
        });
    });

    $(".refresh").keyup(function(event){

        let target = $( event.target );
        if ( target.is( "textarea" ) ) {
            $("."+$(this).data('scope')).html($(this).text());
        }else{
            $("."+$(this).data('scope')).val($(this).val());
        }

    });

    $(".elementShow").click(function(event){
        let target = $( event.target );
        $("."+$(this).data('scope')).fadeIn();
    });
    $(".elementHide").click(function(event){
        let target = $( event.target );
        $("."+$(this).data('scope')).fadeOut();
    });

    $(".elementToggleClass").click(function(){
        let newClass = $(this).data('sclass');
        $(".elementToggleClass").removeClass(newClass)
        $(this).toggleClass(newClass);
    });

    $('.shippingPaymentForm').submit( function (e)
    {
        e.preventDefault();

        $.ajax({
            type: this.method,
            url: this.action,
            data:  $(this).serialize(),
            success : function (response)
            {
                $('.iyzicoPaymentDiv').html(response);
                $('.odeme').tab('show');
                $('html,body').animate({
                    scrollTop: $('body').offset().top
                }, 'slow');
            },
            error: function(response) {

                let error      = '';
                if (response.responseJSON)
                {
                    let error_json = response.responseJSON;
                    for(var k in error_json)
                    {
                        for (var a in error_json[k])
                        {
                            error += error_json[k][a]+"<br>";
                        }
                    }
                }else { error = response.responseText; }
                Swal.fire({
                    allowOutsideClick : false,
                    allowEscapeKey : false,
                    title: 'Oops...',
                    html: error,
                    icon: 'error',
                });

            }
        });
    });


    $(".cartDelete").click(function(event){
        // $(this).closest('tr').remove();
        let key = $(this).data('key');
        let url = $(this).data('action');
        $.ajax({
            type: "POST",
            url: url,
            data: {key:key},
            success: function(response)
            {
                location.reload();
            },
        });
    });




    $(".piece").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });


    function formatNumber(n) {
        // format number 1000000 to 1,234,567

        return n.replace(',', "");
    }


    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") { return; }

        // original length
        var original_len = input_val.length;

        // initial caret position
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
                right_side += "00";
            }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = left_side + "." + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = input_val;


        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }



    function onSubmitMainCustom(t) {
        $(".recaptcha-form-custom").submit();
    }


    function onSubmitMain(t) {
        $(".recaptcha-form").submit();
    }

    function onSubmitMain2(t) {
        //alert(token);
        $(".recaptcha-form-2").submit();
    }

    function onSubmitMain3(t) {
        //alert(token);
        $(".recaptcha-form-3").submit();
    }

    function onSubmitMain4(t) {
        //alert(token);
        $(".recaptcha-form-4").submit();
    }

    function Loading(durum)
    {
        if (durum == 1)
        {
            $('.Loading').fadeIn('slow');
        }
        else if (durum == 2)
        {
            $('.Loading').fadeOut('slow');
        }

    }

    $(".pieceMinus").click(function(event){
        let value = Number($('#'+$(this).data("scope")).val());
        let min = Number($(this).data("min"));
        let url = $(this).data("url");
        let uuid = $(this).data("uuid");
        let key = $(this).data("key");
        setTimeout(function(){
            if (value > min){

                value = (value - 1);
                $('#' + $(this).data("scope")).val(value);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {piece: value, uuid: uuid, key: key},
                    success: function (response) {
                        if (response.status == true) {
                            location.reload();
                        }

                    },
                });

            }

        }, 100);
    });

    $(".piecePlus").click(function(event){
        let status = 0;
        let value = Number($('#'+$(this).data("scope")).val());
        let max = Number($(this).data("max"));
        let url = $(this).data("url");
        let uuid = $(this).data("uuid");
        let key = $(this).data("key");
        setTimeout(function(){


            if (value < max){

                value = (value + 1);
                $('#'+$(this).data("scope")).val(value);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {piece:value,uuid:uuid,key:key},
                    success: function(response)
                    {
                        console.log(response);
                        if (response.status == true){
                            location.reload();
                        }

                    },
                });
            }
        }, 100);



    });






});

function onSubmitMain(token) {
    //alert(token);
    $(".recaptcha-form").submit();
}

function onSubmitMain2(token) {
    //alert(token);
    $(".recaptcha-form-2").submit();
}


function onSubmitMain3(token) {
    //alert(token);
    $(".recaptcha-form-3").submit();
}

function onSubmitMain4(token) {
    //alert(token);
    $(".recaptcha-form-4").submit();
}


function onSubmitMainCustom(token) {
    //alert(token);
    $(".recaptcha-form-custom").submit();
}

function onOfferFormSubmit(token) {
    //alert(token);
    $(".recaptcha-form-offer").submit();
}



