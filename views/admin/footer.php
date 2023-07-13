          <!-- Content wrapper -->
          </div>
        <!-- / Layout page -->
      </div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?=showlinkimage()?>/public/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <!-- jquery ui -->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="<?=showlinkimage()?>/public/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=showlinkimage()?>/public/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="<?=showlinkimage()?>/public/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?=showlinkimage()?>/public/admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->
    <!-- box icon -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <!-- Vendors JS -->
    <script src="<?=showlinkimage()?>/public/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?=showlinkimage()?>/public/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?=showlinkimage()?>/public/admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>

  <script>
        $( ".sortable_slider" ).sortable({
        placeholder: 'ui-state-highlight',
        update: function(event,ui){
            var array_id = [];
            var _token = $('meta[name="csrf-token"]').attr('content');
            $('.sortable_slider tr').each(function(){
                array_id.push($(this).attr('id'));
            })
            // alert(array_id);
            // alert(_token);
            $.ajax({
                url:"http://localhost/phpthuan/views/admin/slide/index.php",
                method:"POST",
                data:{array_id:array_id},
                success: function(data){
                    if(data = 'sapxepthanhcong'){
                      $('#message').html('<div class="alert alert-warning alert-dismissible me-auto" role="alert">Thứ tự slide đã được cập nhật<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                      setTimeout(function(){$('#message').html('')} , 2000);
                    }
                }
            })
        }
        });
  </script>
</html>