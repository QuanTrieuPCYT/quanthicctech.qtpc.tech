<div class="tab-content">
                    <div id="doithe" class="tab-pane fade active in">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                ĐỔI THẺ CÀO TỰ ĐỘNG</div>
                            <div class="panel-body">

                                <div id="loading_box" style="display:none;">
                                    <center><img src="https://doicardnhanh.com/assets/img/loading_box.gif"></center>
                                </div>
                                <div class="row">
                                    <div id="thongbao" class="col-lg-12"></div>
                                    <div id="loading_box" style="display:none;">
                                        <center><img src="https://doicardnhanh.com/assets/img/loading_box.gif"></center>
                                    </div>
                                </div>
                                <div id="divGachthecao">
                                    <div class="gachthe row" data-row="1">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select id="loaithe" class="telco form-control" data-row="1">
<option value="">-- Loại thẻ --</option>
<option value="VIETTEL">
    VIETTEL Auto
</option>
<option value="VINAPHONE">
    VINAPHONE Auto
</option>
<option value="MOBIFONE">
    MOBIFONE Auto
</option>
<option value="ZING">
    ZING Auto
</option>
<option value="VNMOBI">
    VNMOBI Auto
</option>
</select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select id="menhgia" class="charging-amount form-control" data-row="1">
<option value="">-- Chọn mệnh giá --</option>
<option value="10000">10.000đ - Thực nhận 8.300đ</option>
<option value="20000">20.000đ - Thực nhận 16.800đ</option>
<option value="30000">30.000đ - Thực nhận 25.200đ</option>
<option value="50000">50.000đ - Thực nhận 42.000đ</option>
<option value="100000">100.000đ - Thực nhận 84.000đ</option>
<option value="200000">200.000đ - Thực nhận 166.000đ</option>
<option value="300000">300.000đ - Thực nhận 249.000đ</option>
<option value="500000">500.000đ - Thực nhận 405.000đ</option>
<option value="1000000">1.000.000đ - Thực nhận 810.000đ</option></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input id="seri" class="serial form-control" type="text" data-row="1" placeholder="Serial">

                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input id="pin" class="pin form-control" type="text" data-row="1" placeholder="Mã thẻ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button id="btnAddChild" class="btn btn-sm"><img src="https://doicardnhanh.com/assets/img/add-icon.png" width="20px"> THÊM
                                            NGAY</button>

                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-sm" onclick="window.location.reload();" style="float:right"><img src="https://doicardnhanh.com/assets/img/delete-all-icon.png" width="20px"> XOÁ
                                            TẤT CẢ</button>
                                    </div>
                                </div>
                                <input type="hidden" id="token" value="bBxXMiQCuLVFGhWDcZAzmoeHIdYgRSnfpwPtkqsTlyNaJUvKOjrE">
                                <center>
                                    <a type="submit" class="btn" id="NapTheAuto">
                                        <img src="https://doicardnhanh.com/assets/img/button-nap-ngay.gif" width="170px">
                                    </a>
                                </center>
                            </div>



                        </div>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            setTimeout(e => {
                                GetCard24()
                            }, 0)
                        });
                        $('#btnAddChild').click(function() {
                            PlaySound('click');
                            getchildordercardbuy();
                        });

                        function getchildordercardbuy() {
                            var totalRow = $('#divGachthecao .gachthe').length;
                            if (totalRow > 10) {
                                PlaySound('ban_chi_co_the_giu_len_he_thong_toi_da_10_the_1_lan');
                                alert('Bạn chỉ có thể gửi lên hệ thống tối đa 10 thẻ 1 lần');
                            } else {
                                $.ajax({
                                    url: "https://doicardnhanh.com/assets/ajaxs/divGachthecao.php",
                                    method: "GET",
                                    success: function(response) {
                                        $('#divGachthecao').append(response);
                                    }
                                });
                            }
                        }

                        $(document).on('change', '.telco', function() {
                            var dataRow = $(this).data('row');
                            $('.charging-amount[data-row="' + dataRow + '"]').empty();
                            $.ajax({
                                url: "https://doicardnhanh.com/assets/ajaxs/menhgia.php",
                                method: "GET",
                                data: {
                                    loaithe: $(this).val(),
                                    type: $(this).find(':selected').data('type')
                                },
                                success: function(response) {
                                    $('.charging-amount[data-row="' + dataRow + '"]').html(
                                        response);
                                }
                            });
                        });
                        $("#NapTheAuto").click(function() {
                            PlaySound('click');
                            proccessListOrderCardBuy();
                        });

                        function proccessListOrderCardBuy() {
                            var lstDataSubmit = [];
                            var i = 1;
                            $('#divGachthecao .gachthe').each(function() {
                                var dataRow = $(this).data('row');
                                var dataOne = {
                                    loaithe: $('select.telco[data-row="' + dataRow + '"] :selected').val(),
                                    menhgia: $('select.charging-amount[data-row="' + dataRow +
                                            '"] :selected').val() != undefined ?
                                        $('select.charging-amount[data-row="' + dataRow + '"] :selected')
                                        .val() : '',
                                    type: $('select.telco[data-row="' + dataRow + '"] :selected').data(
                                        'type'),
                                    pin: $('input.pin[data-row="' + dataRow + '"]').val(),
                                    serial: $('input.serial[data-row="' + dataRow + '"]').val(),
                                };
                                lstDataSubmit.push(dataOne);
                            });
                            if (lstDataSubmit.length > 0) {
                                $("#loading_box").show();
                                $.ajax({
                                    url: "https://doicardnhanh.com/assets/ajaxs/NapThe2.php",
                                    type: 'POST',
                                    data: {
                                        data: lstDataSubmit,
                                        type: 'NapTheAuto',
                                        token: $("#token").val(),
                                    },
                                    beforeSend: function() {
                                        $('#NapTheAuto').html(
                                            '<img src="https://doicardnhanh.com/assets/img/loading.gif" width="200px">'
                                            );
                                        $('#NapTheAuto').prop('disabled', true);
                                    },
                                    success: function(res) {
                                        $('#NapTheAuto').html(
                                            '<img src="https://doicardnhanh.com/assets/img/button-nap-ngay.gif" width="170px">'
                                        );
                                        $('#NapTheAuto').prop('disabled', false);
                                        $("#thongbao").html(res);
                                        var str2 = "alert-success";
                                        if (res.indexOf(str2) != -1) {
                                            setTimeout(function() {
                                                window.location.href =
                                                    'https://doicardnhanh.com/';
                                            }, 3000);
                                        }
                                        $("#loading_box").hide();
                                    }
                                });
                            }
                        }

                        function GetCard24() {
                            $.ajax({
                                url: "https://doicardnhanh.com/api/loaithe.php",
                                method: "GET",
                                success: function(response) {
                                    $("#loaithe").html(response);
                                }
                            });
                        }
                        </script>
                    </div>
                    <div id="ckdoithe" class="tab-pane fade">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="color:white; background-color: #000000;">
                                BIỂU PHÍ ĐỔI THẺ</div>
                            <div class="panel-body">
                                <div class="tabpage" id="bang-phi">
                                    <ul class="nav nav-tabs">
                                                                                <li class="active">
                                            <a data-toggle="tab" onclick="PlaySound('VIETTEL')" href="#discount-VIETTEL" aria-expanded="false">
                                                <span class="title">VIETTEL</span>
                                            </a>
                                        </li>
                                                                                <li class="">
                                            <a data-toggle="tab" onclick="PlaySound('VINAPHONE')" href="#discount-VINAPHONE" aria-expanded="false">
                                                <span class="title">VINAPHONE</span>
                                            </a>
                                        </li>
                                                                                <li class="">
                                            <a data-toggle="tab" onclick="PlaySound('MOBIFONE')" href="#discount-MOBIFONE" aria-expanded="false">
                                                <span class="title">MOBIFONE</span>
                                            </a>
                                        </li>
                                                                                <li class="">
                                            <a data-toggle="tab" onclick="PlaySound('ZING')" href="#discount-ZING" aria-expanded="false">
                                                <span class="title">ZING</span>
                                            </a>
                                        </li>
                                                                                <li class="">
                                            <a data-toggle="tab" onclick="PlaySound('VNMOBI')" href="#discount-VNMOBI" aria-expanded="false">
                                                <span class="title">VNMOBI</span>
                                            </a>
                                        </li>
                                                                            </ul>
                                    <div class="tab-content" style="padding-top: 20px;">
                                                                                <div class="table-responsive tab-pane fadess active" id="discount-VIETTEL">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nhóm thành
                                                            viên
                                                        </th>
                                                        <th class="text-center">Thẻ 10,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 20,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 30,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 50,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 100,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 200,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 300,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 500,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ
                                                            1,000,000đ
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <tr style="color: red;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/bronzei.png">
                                                            <b>Bronze</b>
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>19%
                                                        </td>
                                                        <td>19%
                                                        </td>
                                                    </tr>
                                                    <tr style="color: green;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/bachkim.png">
                                                            <b>Platinum</b>
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>18%
                                                        </td>
                                                        <td>18%
                                                        </td>
                                                    </tr>
                                                    <tr style="color: blue;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/kimcuong.png">
                                                            <b>Diamond</b>
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>14%
                                                        </td>
                                                        <td>14%
                                                        </td>
                                                        <td>14%
                                                        </td>
                                                        <td>14%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                                                                <div class="table-responsive tab-pane fadess" id="discount-VINAPHONE">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nhóm thành
                                                            viên
                                                        </th>
                                                        <th class="text-center">Thẻ 10,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 20,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 30,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 50,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 100,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 200,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 300,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 500,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ
                                                            1,000,000đ
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <tr style="color: red;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/bronzei.png">
                                                            <b>Bronze</b>
                                                        </td>
                                                        <td>21%
                                                        </td>
                                                        <td>21%
                                                        </td>
                                                        <td>21%
                                                        </td>
                                                        <td>21%
                                                        </td>
                                                        <td>21%
                                                        </td>
                                                        <td>21%
                                                        </td>
                                                        <td>21%
                                                        </td>
                                                        <td>21%
                                                        </td>
                                                        <td>0%
                                                        </td>
                                                    </tr>
                                                    <tr style="color: green;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/bachkim.png">
                                                            <b>Platinum</b>
                                                        </td>
                                                        <td>20%
                                                        </td>
                                                        <td>20%
                                                        </td>
                                                        <td>20%
                                                        </td>
                                                        <td>20%
                                                        </td>
                                                        <td>20%
                                                        </td>
                                                        <td>20%
                                                        </td>
                                                        <td>20%
                                                        </td>
                                                        <td>20%
                                                        </td>
                                                        <td>0%
                                                        </td>
                                                    </tr>
                                                    <tr style="color: blue;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/kimcuong.png">
                                                            <b>Diamond</b>
                                                        </td>
                                                        <td>19%
                                                        </td>
                                                        <td>19%
                                                        </td>
                                                        <td>19%
                                                        </td>
                                                        <td>19%
                                                        </td>
                                                        <td>19%
                                                        </td>
                                                        <td>19%
                                                        </td>
                                                        <td>19%
                                                        </td>
                                                        <td>19%
                                                        </td>
                                                        <td>0%
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                                                                <div class="table-responsive tab-pane fadess" id="discount-MOBIFONE">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nhóm thành
                                                            viên
                                                        </th>
                                                        <th class="text-center">Thẻ 10,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 20,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 30,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 50,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 100,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 200,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 300,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 500,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ
                                                            1,000,000đ
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <tr style="color: red;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/bronzei.png">
                                                            <b>Bronze</b>
                                                        </td>
                                                        <td>27%
                                                        </td>
                                                        <td>27%
                                                        </td>
                                                        <td>27%
                                                        </td>
                                                        <td>27%
                                                        </td>
                                                        <td>27%
                                                        </td>
                                                        <td>27%
                                                        </td>
                                                        <td>27%
                                                        </td>
                                                        <td>27%
                                                        </td>
                                                        <td>0%
                                                        </td>
                                                    </tr>
                                                    <tr style="color: green;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/bachkim.png">
                                                            <b>Platinum</b>
                                                        </td>
                                                        <td>26%
                                                        </td>
                                                        <td>26%
                                                        </td>
                                                        <td>26%
                                                        </td>
                                                        <td>26%
                                                        </td>
                                                        <td>26%
                                                        </td>
                                                        <td>26%
                                                        </td>
                                                        <td>26%
                                                        </td>
                                                        <td>26%
                                                        </td>
                                                        <td>0%
                                                        </td>
                                                    </tr>
                                                    <tr style="color: blue;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/kimcuong.png">
                                                            <b>Diamond</b>
                                                        </td>
                                                        <td>25%
                                                        </td>
                                                        <td>25%
                                                        </td>
                                                        <td>25%
                                                        </td>
                                                        <td>25%
                                                        </td>
                                                        <td>25%
                                                        </td>
                                                        <td>25%
                                                        </td>
                                                        <td>25%
                                                        </td>
                                                        <td>25%
                                                        </td>
                                                        <td>0%
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                                                                <div class="table-responsive tab-pane fadess" id="discount-ZING">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nhóm thành
                                                            viên
                                                        </th>
                                                        <th class="text-center">Thẻ 10,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 20,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 30,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 50,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 100,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 200,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 300,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 500,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ
                                                            1,000,000đ
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <tr style="color: red;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/bronzei.png">
                                                            <b>Bronze</b>
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                    </tr>
                                                    <tr style="color: green;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/bachkim.png">
                                                            <b>Platinum</b>
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                    </tr>
                                                    <tr style="color: blue;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/kimcuong.png">
                                                            <b>Diamond</b>
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                        <td>15%
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                                                                <div class="table-responsive tab-pane fadess" id="discount-VNMOBI">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nhóm thành
                                                            viên
                                                        </th>
                                                        <th class="text-center">Thẻ 10,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 20,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 30,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 50,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 100,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 200,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 300,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ 500,000đ
                                                        </th>
                                                        <th class="text-center">Thẻ
                                                            1,000,000đ
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <tr style="color: red;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/bronzei.png">
                                                            <b>Bronze</b>
                                                        </td>
                                                        <td>18%
                                                        </td>
                                                        <td>18%
                                                        </td>
                                                        <td>18%
                                                        </td>
                                                        <td>18%
                                                        </td>
                                                        <td>18%
                                                        </td>
                                                        <td>18%
                                                        </td>
                                                        <td>18%
                                                        </td>
                                                        <td>18%
                                                        </td>
                                                        <td>0%
                                                        </td>
                                                    </tr>
                                                    <tr style="color: green;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/bachkim.png">
                                                            <b>Platinum</b>
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>17%
                                                        </td>
                                                        <td>0%
                                                        </td>
                                                    </tr>
                                                    <tr style="color: blue;">
                                                        <td><img width="25px" src="https://doicardnhanh.com/assets/img/kimcuong.png">
                                                            <b>Diamond</b>
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>16%
                                                        </td>
                                                        <td>0%
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                                                                <p style="font-size:15px;float:right;">Nhóm của bạn là: <img width="25px" src="https://doicardnhanh.com/assets/img/bronzei.png"> <b>Bronze</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>