$(function () {

          $('.detailData').on('click', function () {
                    const id = $(this).data('id');


                    $.ajax({
                              url: 'http://localhost/simple-todolist/todolist/getdata',
                              data: { id: id },
                              method: 'post',
                              dataType: 'json',
                              success: function (data) {
                                        var now = new Date(data.waktu * 1000);
                                        $('#nama').val(data.nama);
                                        $('#waktu').val(now.toLocaleString());
                                        $('#status').val(data.status);
                                        $('#deskripsi').val(data.deskripsi);
                                        $('#id').val(data.id);
                                        $('.deleteData').attr('data-id', data.id);
                              }
                    });
          });

          //delete record to database
          $('.deleteData').on('click', function () {
                    const id = $(this).data('id');
                    $.ajax({
                              method: "post",
                              url: "http://localhost/simple-todolist/todolist/delete",
                              dataType: "JSON",
                              data: { id: id },
                              success: function (data) {
                                        if (data.status == 'success') {
                                                  location.reload();
                                        }
                              }
                    });
          });
});