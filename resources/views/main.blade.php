@extends('layout.home')

@section('container')
    <div>
        <div>
            <form action="" id="formPegawai" class="">
                <div class="mb-3 w-50">
                    <label for="exampleFormControlInput1" class="form-label">Nama Pegawai</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="John Doe">
                </div>

                <div class="mb-3 w-50">
                    <label for="exampleFormControlInput1" class="form-label">No. Telp</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="12345678">
                </div>

                <div class="mb-3 w-50">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="email@example.com">
                </div>

                <div class="mb-3 w-50">
                    <label for="exampleFormControlInput1" class="form-label">Jabatan</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                    </select>
                </div>

                <div class="mb-3 w-50">
                    <label for="exampleFormControlInput1" class="form-label">Kontrak</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
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
                        
                        document.getElementById('content').innerHTML += table;

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