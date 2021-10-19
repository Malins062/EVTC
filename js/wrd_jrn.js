$(document).ready(function(){

    document.getElementById("s_records").textContent = document.getElementById("s_records0").textContent;
    document.getElementById("s_records_end").textContent = document.getElementById("s_records0").textContent;

    $('.jrn_word').on('click', function(event){
    // $('body').on('click', '.jrn_word', function(event){
         event.preventDefault();
        //получение id формы
        // var formID=$(this).attr('id');
        // var formNm=$('#'+formID);
        // var val=document.getElementById("$_GET");
        // alert($(this).attr('href'));

        $.ajax({
            type: "POST",
            url: 'wrd/word_jrn.php',
            data: {
                'j': $(this).attr('id'),
                'value': $(this).attr('href')},
            cache: false,
            dataType: "html",
            beforeSend:function()
            {
                // alert('Before');
                // $(form_data).html('<p style="text-align:center"> Отправка на ФТП... </p>');
                $('.cssload-loading').html('Передача в MS Word...');
                $('.cssload-loader').attr('style','box-shadow: 0 0 50px greenyellow');
                $('#cssload-wrapper').css('display', '');
                $('.jrn_word').attr('disabled', 'disabled');
            },
            success:function(result){
                // alert(result);
               // window.location.href="wrd/wrd_load.php?file_name="+result;
               //
               if (result != "NOT") {
                   window.location.href="wrd/wrd_load.php?file_name="+result;
               }
            },
            complete:function() {
                // var data=JSON.parse(data);
                //  alert(data);
                // $(form_data).html('<p style="text-align:center">ЗАВЕРШЕНО</p>');
                $('#cssload-wrapper').css('display', 'none');
                $('.jrn_word').attr('disabled', false);
                $('#cssload-wrapper')[0].reset();
                // $('#jurnal')[0].reset();
            },
            error: function(jqXHR,text,error){
                alert(error);
            }
        });

        return false;
    });
});
