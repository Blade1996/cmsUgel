$(function(){
$('#currentPassword').keyup(function(){
    var currentPwd = $('#currentPassword').val();
    $.ajax({
        type: 'post',
        url: '/admin/dashboard/verify-curr-pwd',
        data: { currentPwd },
        success: function(res){
            if(!res){
                $('#verCurrPwd').html('<font color=red>La contraseña actual no es correcta</font>')
            }else{
                $('#verCurrPwd').html('<font color=green>La contraseña actual es correcta</font>')
            }
        },error: function(){
            alert('error');
        }
    })
});

$(document).on('click','.update-status', function(){
    var status = $(this).text();
    var type = $(this).attr('type');
    var id = $(this).attr(`${type}_id`);
    console.log(status, type, id);
    $.ajax({
        type: 'POST',
        url: `/admin/dashboard/upd-${type}-status`,
        data: { status, id },
        success: function(res){
            if(res['status'] == 0){
                $(`#${type}-${res['id']}`).attr('class', 'badge badge-danger update-status').html('Desactivado');
            }else if(res['status'] == 1) {
                $(`#${type}-${res['id']}`).attr('class', 'badge badge-success update-status').html('Activado');
            }
        },error: function(){
            alert('error');
        }
    })
});


var item_slide = $('.item-slide');

    // jQuery UI sortable for the todo list
$('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999,
    stop:   function(event){
        for(var i = 0; i < item_slide.length; i ++){
            var datos = new FormData();
            datos.append('id_slide',  event.target.children[i].id);
            datos.append('order',  i+1);
            $.ajax({
                type: 'post',
                url: '/admin/dashboard/slider/upd-slider-order',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: datos,
                success: function(res){
                    console.log('se ordeno correctamente');
                },error: function(){
                    console.log('error');
                }
            })
        }
    }
})

$(document).on('click' ,'.confirmDelete' , function(){
    var recordId = $(this).attr('recordId');
    console.log(recordId);
    var record = $(this).attr('record');
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No se podrá deshacer la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/admin/dashboard/${record}/delete/${recordId}`;
        }
    })
})


    $(document).on('change', "#sectionId", function() {
    let sectionId =$(this).val();
    if(sectionId !== "100" && sectionId !== "200" && sectionId !== "300"){
        $.ajax({
            url: `section/${sectionId}`,
            success: function(res){
                if(res.sub_categories.length > 0){
                    $("#subCategoryId").empty();
                    $("#subCategoryId").append(`<option value="0"  selected disabled>Seleccione Día</option>`);
                    res.sub_categories.forEach((item) =>{
                        $("#subCategoryId").append(`<option value="${item.id}">${item.name}</option>`);
                    });
                    $("#selectSub").css('display', 'block');
                }else{
                    $("#selectSub").css('display', 'none');
                }
            },error: function(){
                alert('error');
            }
        })
    }else{
        $("#selectSub").css('display', 'none');
    }
})


let categoryDoc = $('#categoryId').val();

if((categoryDoc != null || categoryDoc != undefined) && categoryDoc === "2"){
    $('#documentsFile').css('display', 'none');
    $("#announcement").css('display', 'block');
}else{
    $("#announcement").css('display', 'none');
    $('#documentsFile').css('display', 'block');
}

$(document).on('change', "#categoryId", function(){
    let categoryId = $(this).val();
    console.log(categoryId);
    if(categoryId === "2"){
        $('#documentsFile').css('display', 'none');
        $("#announcement").css('display', 'block');
        $('#checkCaption').css('display', 'none');
        $('#imgSlider').css('display', 'none');
    }else if(categoryId === "11"){
        $('#checkCaption').css('display', 'block');
        $('#imgSlider').css('display', 'block');
    }else{
        $("#announcement").css('display', 'none');
        $('#checkCaption').css('display', 'none');
        $('#documentsFile').css('display', 'block');
        $('#imgSlider').css('display', 'none');
    }
})


let linkType = $("input[name='typelink']:checked").val();

if(linkType === 'external'){
    $('#areaArticleContent').css('display', 'none');
    $("#articleUrlContent").css('display', 'block');
    $("#articleFileContent").css('display', 'none');
} else if (linkType == 'pdf'){
    $('#areaArticleContent').css('display', 'none');
    $("#articleUrlContent").css('display', 'none');
    $("#articleFileContent").css('display', 'block');

} else if (linkType == 'tree') {
    $('#areaArticleContent').css('display', 'block');
    $("#articleUrlContent").css('display', 'none');
    $("#articleFileContent").css('display', 'none');
    $("#selectTree").css('display', 'block');
}
else{
    $('#areaArticleContent').css('display', 'block');
    $("#articleUrlContent").css('display', 'none');
    $("#articleFileContent").css('display', 'none');
}

$(document).on('change', 'input[type=radio][name=typelink]', function(){
    let typeLink = $(this).val();
    if(typeLink === 'external'){
        $('#areaArticleContent').css('display', 'none');
        $("#articleUrlContent").css('display', 'block');
        $("#articleFileContent").css('display', 'none');
        $("#selectTree").css('display', 'none');
    } else if (typeLink == 'pdf'){
        $('#areaArticleContent').css('display', 'none');
        $("#articleUrlContent").css('display', 'none');
        $("#articleFileContent").css('display', 'block');
        $("#selectTree").css('display', 'none');
    }else if (typeLink == 'tree'){
        $('#articleFileContent').css('display', 'none');
        $('#areaArticleContent').css('display', 'block');
        $("#articleUrlContent").css('display', 'none');
        $("#articleFileContent").css('display', 'none');
        $("#selectTree").css('display', 'block');
    } else{
        $('#areaArticleContent').css('display', 'block');
        $("#articleUrlContent").css('display', 'none');
        $("#articleFileContent").css('display', 'none');
        $("#selectTree").css('display', 'none');
    }
})

/* $(document).on('click', '#showCaption', function(){
    let showCaption  = $(this).is(':checked');
    if(showCaption) {
        $(".captionSlider").css('display', 'block');
    }else{
        $(".captionSlider").css('display', 'none');
        $("#titleCaption").val('');
        $("#subTitleCaption").val('');
    }
})*/

$(document).on('click', '#isParent', function(){
    let isParent = $(this).is(':checked');
    if(!isParent) {
        $("#fileNode").css("display", 'block');
        $("#parentSelect").css("display", 'block');
    }else{
        $("#fileNode").css('display', 'none');
        $("#parentSelect").css('display', 'none');
    }
})
})
