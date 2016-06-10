WS = {
    "url": BASE_URL + "api/",
    "result": [],
    "data": {},
    "post": function (api, callback) {
        $.ajax({
            url: this.url + api,
            method: 'POST',
            dataType: 'JSON',
            data: this.data,
            beforeSend: function (xhr)
            {
                loading_on();
                console.log("ws before send");
            }
        })
                .done(function (data)
                {
                    WS.result = data;
                    if (WS.result.response_code === 200) {
                        if (callback && typeof (callback) === "function") {
                            callback();
                        }
                    } else {
                        alert(WS.result.response_status);
                    }
                })
                .fail(function (jqXHR, textStatus, errorThrown)
                {
                    alert("Terdapat kesalahan koneksi ke server");
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                })
                .always(function (jqXHR, textStatus)
                {
                    loading_off();
                    console.log("selesai ws");
                });
    }
};

TABEL = {
    name: "",
    data: [],
    obj: {},
    newRow: {},
    api: "",
    aksi: "tambah",
    pilihan: {},
    kolom: [],
    inisiasi: function () {
        if (this.name === "") {
            alert("inisiasi gagal");
            return false;
        }

        if (TABEL.obj.length === undefined) {
            TABEL.obj = $(this.name).DataTable({
                data: this.data,
                columns: this.kolom,
                scrollX: true
            });
        }else{
            TABEL.obj.clear().rows.add(TABEL.data).draw();
        }
    },
    tambah: function () {
        WS.data = TABEL.newRow;
        WS.post(TABEL.api, function () {
            console.log("selesai tambah");
            TABEL.newRow.id = WS.result.response_data.last_id;

            if (TABEL.aksi === 'tambah') {
                // proses tambah ibu baru
                TABEL.obj.row.add(TABEL.newRow).draw(false);
            } else if (TABEL.aksi === 'ubah') {
                // proses update ibu baru
//                console.log("ngubah");
//                console.log(TABEL.pilihan);
//                console.log(TABEL.newRow);
                TABEL.obj.row(TABEL.pilihan).data(TABEL.newRow).draw();
            }

            // sorting yg id paling baru di atas
            TABEL.obj.order([0, 'desc']).draw();

            alert("Berhasil tersimpan");
        });
    },
    hapus: function () {
        WS.data = TABEL.pilihan;
        WS.post(TABEL.api, function () {
            console.log("proses hapus");
            TABEL.newRow.id = WS.result.response_data.last_id;

            if (WS.result.response_code == 200) {
                TABEL.obj.row(TABEL.pilihan).remove().draw();

                // sorting yg id paling baru di atas
                TABEL.obj.order([0, 'desc']).draw();

            } else {
                alert("terdapat kesalahan saat hapus");
            }
        });
    }
};