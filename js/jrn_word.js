$(document).ready(function(){
    $('.wrd_jrn').on('click', function(event){
         event.preventDefault();
        //получение id формы
        // var formID=$(this).attr('id');
        // var formNm=$('#'+formID);
        // alert( $(this).attr('href'));

        $.ajax({
            type: "POST",
            // url:alert($(this).attr('href')),
            url: 'word/word_jrn.php',
            data: {'j': $(this).attr('href')},
            cache: false,
            // processData: false,
            // contentType: false,
            beforeSend:function()
            {
                alert('Before');
                // $(form_data).html('<p style="text-align:center"> Отправка на ФТП... </p>');
            },
            success:function(){
            },
            complete:function() {
                alert('Complete');
            },
            error: function(jqXHR,text,error){
                alert(error);
            }
        });
        return false;
    });
});
