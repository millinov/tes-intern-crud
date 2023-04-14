@extends('layout.home')

@section('container')
    <div>
        <div>
            <form action="{{ $app_url }}/api/pegawai" id="formPegawai" method="post" class="">
                @csrf
                <div class="mb-3 w-50">
                    <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                    <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="John Doe" required>
                    <div class="text-danger mb-2" name="nama_pegawai_error" id="nama_pegawai_error">
                    </div>
                </div>

                <div class="mb-3 w-50">
                    <label for="no_telp" class="form-label">No. Telp</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="12345678" required>
                    <div class="text-danger mb-2" name="no_telp_error" id="no_telp_error">
                    </div>
                </div>

                <div class="mb-3 w-50">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                    <div class="text-danger mb-2" name="email_error" id="email_error">
                    </div>
                </div>

                <div class="mb-3 w-50">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select class="form-select" name="jabatan_id" id="jabatan_id" aria-label="Default select example" required>
                    </select>
                    <div class="text-danger mb-2" name="jabatan_id_error" id="jabatan_id_error">
                    </div>
                </div>

                <div class="mb-3 w-50">
                    <label for="kontrak" class="form-label">Kontrak</label>
                    <select class="form-select" name="kontrak_id" id="kontrak_id" aria-label="Default select example" required>
                        
                    </select>
                    <div class="text-danger mb-2" name="kontrak_id_error" id="kontrak_id_error">
                    </div>
                </div>

                <button class="w-50 btn btn-lg btn-primary fs-4 mb-3" name="submit" type="submit">SUBMIT</button>
            </form>
        </div>

        <hr/>

        <table>
            <thead>
                <tr>
                    <th class="ml-5"><b>Nama Pegawai</b></th>
                    <th class="ml-5"><b>No. Telp</b></th>
                    <th class="ml-5"><b>Email</b></th>
                    <th class="ml-5"><b>Jabatan</b></th>
                    <th class="ml-5"><b>Kontrak</b></th>
                </tr>
            </thead>
            <tbody id="content">

            </tbody>
        </table>

    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            loadData();

            $('#formPegawai').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type:$(this).attr('method'),
                    url:$(this).attr('action'),
                    data:$(this).serialize(),
                    success: function (textStatus, status) {
                        resetError();
                        resetForm();
                        loadData();
                    },
                    error: function(data) {
                        var errorMsg = data.responseJSON;
                        var errorHtml = "";
                        resetError();

                        $.each(errorMsg.errors, function(key, value) {
                            var idHtml = key+"_error";
                            errorHtml = '<p>'+value+'</p>';
                            document.getElementById(idHtml).innerHTML = errorHtml;
                        });
                    }

                });
            });
        });

        function resetError()
        {
            document.getElementById("kontrak_id_error").innerHTML = "";
            document.getElementById("jabatan_id_error").innerHTML = "";
            document.getElementById("email_error").innerHTML = "";
            document.getElementById("no_telp_error").innerHTML = "";
            document.getElementById("nama_pegawai_error").innerHTML = "";
        }

        function resetForm()
        {
            $('#kontrak_id').change(function(){
                var data= $(this).val();          
            });

            $('#jabatan_id').change(function(){
                var data= $(this).val();          
            });

            $('[type=text]').val('');
            $('#kontrak_id').val('1').trigger('change');
            $('#jabatan_id').val('1').trigger('change');
        }
        

        function loadData()
        {

            $.get('{{ $app_url }}/api/pegawai',function(data){
                var dataPegawai = JSON.parse(JSON.stringify(data)).data;

                $.get('{{ $app_url }}/api/jabatan',function(data1){
                    var dataJabatan = JSON.parse(JSON.stringify(data1)).data;

                    $.get('{{ $app_url }}/api/kontrak',function(data2){
                        var dataKontrak = JSON.parse(JSON.stringify(data2)).data;    
                        var table = "";
                        var tableBody = document.createElement('tbody');

                        for(let i=0; i<dataPegawai.length; i++)
                        {
                            table += "<tr>";
                            table += "<td>"+dataPegawai[i].nama_pegawai+"</td>";
                            table += "<td>"+dataPegawai[i].no_telp+"</td>";
                            table += "<td>"+dataPegawai[i].email+"</td>";
                            table += "<td>"+dataJabatan[dataPegawai[i].jabatan_id-1].nama_jabatan+"</td>";
                            table += "<td>"+dataKontrak[dataPegawai[i].kontrak_id-1].lama_kontrak+"</td>";
                            table += "<td>"+"<button class=\"deletePegawai\" data-id=\""+dataPegawai[i].id+"\">Delete</button>"+"</td>";
                            table += "</tr>";
                        }

                        var opsi ="<option value=\"\" selected>Jabatan</option>";
                        var kontrak ="<option value=\"\" selected>Pilih Kontrak</option>";

                        for(let i = 0; i <dataJabatan.length; i++)
                        {
                            opsi += "<option value=\""+dataJabatan[i].id+"\">"+dataJabatan[i].nama_jabatan+"</option>";
                        }

                        for(let i = 0; i <dataKontrak.length; i++)
                        {
                            kontrak += "<option value=\""+dataKontrak[i].id+"\">"+dataKontrak[i].lama_kontrak+"</option>";
                        }
                        
                        document.getElementById('content').innerHTML = table;
                        document.getElementById('jabatan_id').innerHTML = opsi;
                        document.getElementById('kontrak_id').innerHTML = kontrak;

                        $('.deletePegawai').click(function(e){
                            var id = $(this).data("id");
                            $.ajax({
                                type:'DELETE',
                                url:'{{ $app_url }}/api/pegawai/'+id,
                                success: function (data, status) {
                                    loadData();
                                    alert("Pegawai sudah di hapus");
                                },
                                error: function(data) {
                                    var errors = data.responseJSON;
                                    console.log(errors);
                                }

                            });
                        });
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