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
                                        $('.deleteData').attr('href', "http://localhost/simple-todolist/todolist/delete/" + data.id);
                              }
                    });
          });

});