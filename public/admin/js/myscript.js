
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});
$("div.alert").delay(3000).slideUp();

function confirmDelete(mss){
    if(window.confirm(mss)){
        return true;
    }
    return false;

}
$(document).ready(function(){
    $("#addImages").click(function () {
        $('#insert').append(' <div class="form-group"><label>Images</label><input type="file" name="fProductDetail[]"></div>')
    });
});
$(document).ready(function(){
    $("a#del_img_demo").on('click',function () {
        var url = "http://localhost:81/project/admin/product/delimg/";
        var _token = $("form[name='frmEdit']").find("input[name='_token']").val();
        var idHinh = $(this).parent().find("img").attr("idHinh");
        var img = $(this).parent().find("img").attr("src");
        var rid = $(this).parent().find("img").attr("id");
        $.ajax({
            url: url + idHinh,
            type: 'GET',
            data: {"_token":_token,"idHinh":idHinh,"urlHinh":img},
            success: function(data){
                if(data == 1){
                   $("#hinh_"+idHinh).remove();
                }
                else{
                    alert ("Co loi xay ra");
                }

            }
        })
    });
});