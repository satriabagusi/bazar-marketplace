$(document).ready(function(){

    //INITIALIZE IMAGE UPLOADER
    $('.input-images').imageUploader();
});

$(document).ready(function(){

    //FORMAT MATA UANG
    $('#hargaproduk').mask('000.000.000', {reverse: true});
    $('#nomorpekerja').mask('0000000', {reverse:true});
    $('#nohp').mask('00000000000000', {reverse:true});
    $('#total_transaksi').mask('000.000.000', {reverse: true});

});

$(document).ready(function(){

    var stock = $('#jumlahPesanan').val();
    var total_transaksi = $('#total_transaksi').cleanVal();
    var max_stock = 10;
    $("#tambah_stock").click(function(){
        stock++;
        let total = total_transaksi * stock;
        $('#total_transaksi').val(total);
        $('#jumlahPesanan').val(stock);
        $('#total_transaksi').trigger('input');
        $('#total_poin').text(total/5000);
        if (stock > 1) {
            $('#kurangi_stock').attr('disabled', false);
        }
        if(stock == max_stock){
            $('#tambah_stock').attr('disabled', true);
        }
    });

    $("#kurangi_stock").click(function(){
        stock--;
        let total = parseInt(total_transaksi) * stock;
        $('#total_transaksi').val(total);
        $('#total_transaksi').trigger('input');
        $('#jumlahPesanan').val(stock);
        $('#total_poin').text(total/5000);
        $('#tambah_stock').attr('disabled', false);
        if (stock < 2) {
            $('#kurangi_stock').attr('disabled', true);
        }
    });

});

$(document).ready(function(){
    $('#password').keyup( function(){
        if ($('#password').val().length < 4 ) {
            $('#password').addClass('is-invalid');
            $('#error-message-length').toggle();
        }else{
            $('#password').removeClass('is-invalid');
        }
    })

    $('#passwordConfirm').on('input', function() {
        var password1 = $('#password').val();
        var password2 = $('#passwordConfirm').val();


        if(password1 !== password2) {
            $('#passwordConfirm').addClass('is-invalid');
            $('#error-message-confirm').toggle();
        }else{
            $('#password').removeClass('is-invalid');
            $('#passwordConfirm').removeClass('is-invalid');
        }
    });
});

$(document).ready(function(){

    $('#hapusModal').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id');
        $(this).find("#btn-hapus").attr('href', '/produk/hapus/'+id);
      });

});

$(document).ready(function(){

    $('#terimaModal').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id');
        $(this).find("#btn-terima").attr('href', '/pembeli/dashboard/transaksi/terima/'+id);
      });


});

$(document).ready(function(){

    $('#aktivasiModal').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id');
        console.log(id);
        $(this).find("#btn-aktivasi").attr('href', '/superuser/dashboard/aktivasi/'+id);
      });

});

$(document).ready(function(){

    $('#nonAktifModal').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id');
        console.log(id);
        $(this).find("#btn-aktivasi").attr('href', '/superuser/dashboard/nonaktif/'+id);
      });

});

$(document).ready(function(){

    $('#hapusAkunModal').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id');
        $(this).find("#btn-hapus").attr('href', '/superuser/dashboard/hapus-akun/'+id);
      });

});



$(document).ready(function(){
    $('form').submit(function(){
        $(':disabled').each(function(e){
            $(this).removeAttr('disabled')
        })
    })
});

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#upload-bukti').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $("#imgInp").change(function() {
    readURL(this);
  });


