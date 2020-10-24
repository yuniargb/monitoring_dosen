$(document).ready(function () {
    $('.select2').select2({
        theme: 'bootstrap4',
    });
    // swal confirm
    $('.btn-del').on('submit', function (e) {
        let url = $(this).attr('action')
        // console.log(url);
        e.preventDefault();
        Swal.fire({
            title: 'Anda yakin ingin menghapus data ini??',
            text: "Data akan terhapus secara permanen!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.value) {
                // $(this).serialize()
                // $('.btn-del').submit();
                $.ajax({
                    type: 'delete',
                    url: url,
                    data: $(this).serialize(),
                    success: function (data) {
                        // console.log(data)
                        document.location.href = data;
                    }
                })
            }
        });
    });

    $('.btn-confirm').on('submit', function (e) {
        let url = $(this).attr('action')
        // console.log(url);
        e.preventDefault();
        console.log('aaa')
        Swal.fire({
            title: 'Anda yakin ingin konfirmasi data ini??',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.value) {
                // $(this).serialize()
                // $('.btn-del').submit();
                $.ajax({
                    type: 'put',
                    url: url,
                    data: $(this).serialize(),
                    success: function (data) {
                        // console.log(data)
                        // document.location.href = data;
                        location.reload();
                    }
                })
            }
        });
    });


    $('.btn-logout').on('click', function (e) {
        let url = $(this).attr('href')
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin ingin keluar?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                document.location.href = url;
            }
        });
    });

    $('.btn-passs').on('click', function (e) {
        console.log('ok')
        // let url = $(this).data('url')
        // let text = $(this).data('original-title')
        e.preventDefault();
        // Swal.fire({
        //     title: 'Are you sure?',
        //     text: "You won't be able to revert this!",
        //     type: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: text
        // }).then((result) => {
        //     if (result.value) {
        //         $.ajax({
        //             type: 'get',
        //             url: url,
        //             data: $(this).serialize(),
        //             success: function (data) {
        //                 document.location.href = data;
        //             }
        //         })
        //     }
        // });
    });

    $('.detail-bukti').on('click', function () {
        let gambar = $(this).data('image')

        $('#datagambar').attr('src', gambar)
    });
    $('#showpass').hide()
    $('#password1').on('keyup', function () {
        $p1 = $(this).val();
        $p = $('#password').val();

        if ($p1 != $p) {
            $('#save').attr('disabled', true)
            $('#showpass').show()
        } else {
            $('#showpass').hide()
            $('#save').attr('disabled', false)
        }
    })
    // swal confirm
    $('.kon').on('click', function (e) {
        let url = $(this).data('url')
        let text = $(this).data('original-title')
        e.preventDefault();
        Swal.fire({
            title: 'Kamu yakin ingin merubah data ini?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: text
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'get',
                    url: url,
                    data: $(this).serialize(),
                    success: function (data) {
                        document.location.href = data;
                    }
                })
            }
        });
    });



})
