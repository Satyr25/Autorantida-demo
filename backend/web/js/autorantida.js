$(document).ready(function(){
    
    $('.container-click-archivo').click(function(){
        $('#entrada-input-archivo').trigger('click');
    });
    
    $('#entrada-input-archivo').on('change', function(){
        if (document.getElementById('entrada-input-archivo').files && document.getElementById('entrada-input-archivo').files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.documento-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(document.getElementById('entrada-input-archivo').files[0]);
        }
    });  
    $('.wysi').summernote({
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']],
        ],
    });
    
});