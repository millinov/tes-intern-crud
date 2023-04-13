@extends('layout.home')

@section('container')
    <div>
        <div>
            <form action="" id="formPegawai" class="">
                @csrf
                <div class="mb-3 w-50">
                    <label for="pegawai" class="form-label">Nama Pegawai</label>
                    <input type="text" class="form-control" id="pegawai" name="pegawai" placeholder="John Doe">
                </div>

                <div class="mb-3 w-50">
                    <label for="no_telp" class="form-label">No. Telp</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="12345678">
                </div>

                <div class="mb-3 w-50">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="email@example.com">
                </div>

                <div class="mb-3 w-50">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select class="form-select" name="jabatan_id" id="jabatan_id" aria-label="Default select example">
                        <option value="" selected>Jabatan</option>
                    </select>
                </div>

                <div class="mb-3 w-50">
                    <label for="kontrak" class="form-label">Kontrak</label>
                    <select class="form-select" name="kontrak_id" id="kontrak_id" aria-label="Default select example">
                        <option value="" selected>Pilih Kontrak</option>
                    </select>
                </div>

                <button class="w-50 btn btn-lg btn-primary fs-4 mb-3" type="submit">SUBMIT</button>
            </form>
        </div>

        <hr/>

        <table id="content">
            <tr>
                <td class="ms-10"><b>Nama Pegawai</b></td>
                <td class="ms-10"><b>No. Telp</b></td>
                <td class="ms-10"><b>Email</b></td>
                <td class="ms-10"><b>Jabatan</b></td>
                <td class="ms-10"><b>Kontrak</b></td>
            </tr>
        </table>

    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            loadData();
        });

        function loadData()
        {
            var table = document.createElement('table');
            var tableBody = document.createElement('tbody');

            $.get('http://tes-intern-crud.test/api/pegawai',function(data){
                var dataPegawai = JSON.parse(JSON.stringify(data)).data;

                var table = "";

                $.get('http://tes-intern-crud.test/api/jabatan',function(data1){
                    var dataJabatan = JSON.parse(JSON.stringify(data1)).data;

                    $.get('http://tes-intern-crud.test/api/kontrak',function(data2){
                        var dataKontrak = JSON.parse(JSON.stringify(data2)).data;
                        console.log(dataJabatan);
                        console.log(dataKontrak);
                        console.log(dataPegawai);

                        for(let i=0; i<dataPegawai.length; i++)
                        {
                            table += "<tr>";
                            table += "<td>"+dataPegawai[i].nama_pegawai+"</td>";
                            table += "<td>"+dataPegawai[i].no_telp+"</td>";
                            table += "<td>"+dataPegawai[i].email+"</td>";
                            table += "<td>"+dataJabatan[dataPegawai[i].jabatan_id-1].nama_jabatan+"</td>";
                            table += "<td>"+dataKontrak[dataPegawai[i].kontrak_id-1].lama_kontrak+"</td>";
                            table += "</tr>";
                        }

                        var opsi ="";
                        var kontrak ="";

                        for(let i = 0; i <dataJabatan.length; i++)
                        {
                            opsi += "<option value=\""+dataJabatan[i].id+"\">"+dataJabatan[i].nama_jabatan+"</option>";
                        }

                        for(let i = 0; i <dataKontrak.length; i++)
                        {
                            kontrak += "<option value=\""+dataKontrak[i].id+"\">"+dataKontrak[i].lama_kontrak+"</option>";
                        }
                        
                        document.getElementById('content').innerHTML += table;
                        document.getElementById('jabatan_id').innerHTML += opsi;
                        document.getElementById('kontrak_id').innerHTML += kontrak;
                    })
                })

                // for(let i=0; i<dataPegawai.length; i++)
                // {
                //     table += "<tr>";
                //     table += "<td>"+dataPegawai[i].nama_pegawai+"</td>";
                //     table += "<td>"+dataPegawai[i].no_telp+"</td>";
                //     table += "<td>"+dataPegawai[i].email+"</td>";
                //     table += "<td>"+dataPegawai[i].jabatan_id+"</td>";
                //     table += "<td>"+dataPegawai[i].kontrak_id+"</td>";
                //     table += "</tr>";
                // }

            });
        }
    </script>
@endsection