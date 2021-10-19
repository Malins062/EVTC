function conv_size(b){

    fsizekb = b / 1024;
    fsizemb = fsizekb / 1024;
    fsizegb = fsizemb / 1024;
    fsizetb = fsizegb / 1024;

    if (fsizekb <= 1024) {
        fsize = fsizekb.toFixed(3) + ' KБ';
    } else if (fsizekb >= 1024 && fsizemb <= 1024) {
        fsize = fsizemb.toFixed(3) + ' МБ';
    } else if (fsizemb >= 1024 && fsizegb <= 1024) {
        fsize = fsizegb.toFixed(3) + ' ГБ';
    } else {
        fsize = fsizetb.toFixed(3) + ' ТБ';
    }

    return fsize;
}

function NowDate(minute){
    var d = new Date();
    // d = ('0' + d.getDate()).slice(-2) + '.' + ('0' + (d.getMonth() + 1)).slice(-2) + '.' + d.getFullYear();
    switch (minute) {
        case 1:
            d = d.getFullYear()+'-'+('0' + (d.getMonth() + 1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2);
            break;
        case 2:
            d = d.getFullYear()+'-'+('0' + (d.getMonth() + 1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2)+' '+('0' + (d.getHours())).slice(-2) + ':' + ('0' + d.getMinutes()).slice(-2);
            break;
        case 3:
            d = ('0' + (d.getHours())).slice(-2) + ':' + ('0' + d.getMinutes()).slice(-2);
            break;
        case 4:
            d = d.getFullYear()+'-'+('0' + (d.getMonth() + 1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2)+'T'+('0' + (d.getHours())).slice(-2) + ':' + ('0' + d.getMinutes()).slice(-2)+':00.000Z';
            break;
    }
    return d;
}

$('#i2_date').on('focusout', function(){
    // alert ( NowDate() );
    // alert ( this.value);
    var time = document.getElementById('i2_time').value;

    // alert(this.value+'T'+time+':00.000Z');
    // $dd = Date.parse(this.value+'T'+(time)+':00.000Z');
    // alert($dd);
    // alert(Date.parse(Date()));

    if ( Date.parse(this.value+'T'+(time)+':00.000Z') > Date.parse(NowDate(4)) )
    {
        alert ( "ВНИМАНИЕ! Дата и время задержания ТС не должна быть больше текущей!\r\n" +
            "Дата и время задержания ТС: " + this.value + ' ' + time + ',\r\n'+
            "текущая дата и время: " + NowDate(2) );
        this.value = NowDate(1);
    }
});

$('#i2_time').on('focusout', function(){
    // alert ( NowDate() );
    // alert ( this.value);
    var i_data = document.getElementById('i2_date').value;

    // alert(this.value+'T'+time+':00.000Z');
    // $dd = Date.parse(this.value+'T'+(time)+':00.000Z');
    // alert($dd);
    //  alert(Date.parse(i_data+'T'+this.value+':00.000Z') +'     '+ Date.parse(NowDate(4)) );

    if ( Date.parse(i_data+'T'+this.value+':00.000Z') > Date.parse(NowDate(4)) )
    {
        alert ( "ВНИМАНИЕ! Дата и время задержания ТС не должна быть больше текущей!\r\n" +
            "Дата и время задержания ТС: " + i_data + ' ' + this.value + ',\r\n'+
            "текущая дата и время: " + NowDate(2) );
        this.value = NowDate(3);
    }
});

$('#file1').on('change', function(){

    var sizef1=document.getElementById('file1').files[0].size;
    var namef1=document.getElementById('file1').files[0].name;
    var sizef2=document.getElementById('file2').files[0].size;
    var namef2=document.getElementById('file2').files[0].name;
    // alert(conv_size(sizef1));

    if ((sizef1/1024/1024)>3) {
        alert("ВНИМАНИЕ! Размер фотографии протокола задержания должен быть не более 3 Мб!\r\n" +
            "Размер фото протокола: " + namef1 + ' = ' + conv_size(sizef1)+'.');
        this.value = '';
    } else  if ( (sizef2 == sizef1) && (this.value!='') )
    {
        alert ( "ВНИМАНИЕ! Фотографии протокола и ТС не должны быть одинаковы!\r\n"+
            "Размер фото протокола: " +namef2 +' = ' + conv_size(sizef2) + ',\r\n'+
            "размер фото ТС: " +namef1 +' = ' + conv_size(sizef1) + '.\r\n');
        this.value='';
    }
});

$('#file2').on('change', function(){

    var sizef2=document.getElementById('file2').files[0].size;
    var namef2=document.getElementById('file2').files[0].name;
    var sizef1=document.getElementById('file1').files[0].size;
    var namef1=document.getElementById('file1').files[0].name;
    // alert(conv_size(sizef2));

    if ((sizef2/1024/1024)>3) {
        alert("ВНИМАНИЕ! Размер фотографии протокола задержания должен быть не более 3 Мб!\r\n" +
            "Размер фото ТС: " + namef2 + ' = ' + conv_size(sizef2)+'.');
        this.value = '';
    } else  if ( (sizef2 == sizef1) && (this.value!='') )
    {
        alert ( "ВНИМАНИЕ! Фотографии протокола и ТС не должны быть одинаковы!\r\n"+
            "Размер фото протокола: " +namef2 +' = ' + conv_size(sizef2) + ',\r\n'+
            "размер фото ТС: " +namef1 +' = ' + conv_size(sizef1) + '.\r\n');
        this.value='';
    }
});

$(document).ready(function(){
    // $('#f_input2').on('edit', function() {
    //     alert('key');
    // });
    //     $('#i2_date').on('edit', function(){
    //     alert('key');
    //     if $('.form_input[name="i2_date"]').val()>date() {
    //         alert('Дата будущая');
    //     }
    // });

    $('#f_input2').on('submit', function(event){
        event.preventDefault();
        //получение id формы
        // var formID=$(this).attr('id');
        // var formNm=$('#'+formID);
        var form_data=new FormData(document.getElementById("f_input2"));
        // alert ( "1" );
        // alert ( Date());
        // alert (form_data);

        $.ajax({
            type: "POST",
            url:"insert2.php",
            data: form_data,
            processData: false,
            contentType: false,
            // async: false,
            cache: false,
            beforeSend:function()
            {
                // $(form_data).html('<p style="text-align:center"> Отправка на ФТП... </p>');
                $('.cssload-loading').html('Передача данных...');
                $('.cssload-loader').attr('style','box-shadow: 0 0 50px red');
                $('#cssload-wrapper').css('display', '');
                $('#insert_2').attr('disabled', 'disabled');
            },
            success:function(){

                $('#insert_2').attr('disabled', false);
                $('#f_input2')[0].reset();
            },
            complete:function() {
                // $(form_data).html('<p style="text-align:center">ЗАВЕРШЕНО</p>');
                $('#cssload-wrapper').css('display', 'none');
                $('#cssload-wrapper')[0].reset();
            },
            error: function(jqXHR,text,error){
                $(form_data).html(error);
            }
        });
        // }
        return false;
    });
});