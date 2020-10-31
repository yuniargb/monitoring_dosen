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
                        location.reload();
                    }
                })
            }
        });
    });
    $('.btn-delt').on('click', function (e) {
        let url = $(this).data('action')
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
                        location.reload();
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

        let url = $(this).data('url')
        let downloads = $(this).data('download')

        $.ajax({
            type: 'get',
            url: url,
            success: function (data) {
                var html = '';
                data.forEach(val => {
                    html += `
                        <a href="${downloads}/${val.filename}" class="btn btn-danger btn-round btn-sm w-100 text-light mt-3" target="_blank">
                        Download ${val.filename}
                        </a>
                    `
                });
                $('#detail-file').html(html)

            }
        })
    });
    $('.detail-pengajuan-dosen').on('click', function () {

        let nidn = $(this).data('nidn'),
            nama = $(this).data('nama'),
            alamat = $(this).data('alamat'),
            jabatan = $(this).data('jabatan'),
            fakultas = $(this).data('fakultas'),
            prodi = $(this).data('prodi');
        var html = `
                <dl class="row">
                    <dt class="col-sm-3">NIDN</dt>
                    <dd class="col-sm-9">${nidn}</dd>
                    <dt class="col-sm-3">Nama</dt>
                    <dd class="col-sm-9">${nama}</dd>
                    <dt class="col-sm-3">Alamat</dt>
                    <dd class="col-sm-9">${alamat}</dd>
                    <dt class="col-sm-3">Jabatan Fungsional</dt>
                    <dd class="col-sm-9">${jabatan}</dd>
                    <dt class="col-sm-3">Fakultas</dt>
                    <dd class="col-sm-9">${fakultas}</dd>
                    <dt class="col-sm-3">Prodi</dt>
                    <dd class="col-sm-9">${prodi}</dd>
                </dl>
                `
        $('#detail-pengajuan').html(html)
    });
    // $('.detail-bukti').on('click', function () {
    //     let gambar = $(this).data('image')

    //     $('#datagambar').attr('src', gambar)
    // });
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

    $('.btn-bidang_a').on('click', function (e) {
        var $i = 'a',
            $ft = 'bidang_a',
            id = '#data-bidang_a'
        addBidang($i, $ft, id)
    })
    $('.btn-bidang_b').on('click', function (e) {
        var $i = 'b',
            $ft = 'bidang_b',
            id = '#data-bidang_b'
        addBidang($i, $ft, id)
    })
    $('.btn-bidang_c').on('click', function (e) {
        var $i = 'c',
            $ft = 'bidang_c',
            id = '#data-bidang_c'
        addBidang($i, $ft, id)
    })
    $('.btn-bidang_d').on('click', function (e) {
        var $i = 'd',
            $ft = 'bidang_d',
            id = '#data-bidang_d'
        addBidang($i, $ft, id)
    })
    $('.btn-bidang_lainnya').on('click', function (e) {
        var $i = 'lainnya',
            $ft = 'lainnya',
            id = '#data-bidang_lainnya'
        addBidang($i, $ft, id)
    })
    var ix = 1;
    function addBidang($i, $ft, id) {
        $(id).append(`
            <div class="form-group">
                 <input type="file" class="form-control " name="${$ft}[]" id="xx-${ix}">
                    <button type="button" class="btn btn-danger btn-sm btn-delete mt-1" id="${ix}"><i
                                                                class="fa fa-times"></i></button>
            </div>
        `)
        ix++;
    }

    $('.btn-ba_senat').on('click', function (e) {
        var $i = 'a',
            $ft = 'basenat',
            id = '#data-ba_senat'
        addBidang($i, $ft, id)
    })
    $(document).on('click', '.btn-delete', function (e) {
        var vals = $(this).attr('id')
        $(`#xx-${vals}`).remove();
        $(`#${vals}`).remove();
    })
})
