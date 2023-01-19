<a id="logout" href="<?= base_url('auth/logout')?>" >logout</a>
<!-- 
<script>
  $("#logout").off("click");
  $(document).on("click", "#logout", function (e) {
    e.preventDefault();
    console.log('oke');

    // var data = $("#f_login").serialize();
    $.ajax({
      method: "post",
      url: "<?= base_url()?>auth/logout",
    //   data: data,
      cache: false,
      dataType: "json",
      success: function (data) {
        // console.log(data);
        var message = data.message;
        
          Swal.fire({
            // position: 'top-end',
            icon: message.icon,
            title: message.title,
            text: message.text,
            showConfirmButton: false,
            timer: 3000,
          }); 
          if(data.success){
            setTimeout(function () {
              
              window.location = '<?= base_url('auth')?>';
            }, 3000);  
          }
        
      },
    });
  });
</script> -->