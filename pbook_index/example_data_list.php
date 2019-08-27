<?php include __DIR__ . '/__html_head.php' ?>
<style>
    body{
        background: url(../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/__html_body.php' ?>
<?php include __DIR__ . '/__navbar.php' ?>
    <!-- 右邊section資料欄位 -->
    <section>
        <div class="container">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div>
                    <h4>廠商總表</h4>
                    <div class="title_line"></div>
                </div>
                <ul class="nav justify-content-between">
                    <li class="nav-item">
                        <div style="padding: 0.375rem 0.75rem;">
                            <i class="fas fa-check"></i>
                            目前總計___筆資料
                        </div>
                    </li>
                    <li class="nav-item" style="margin: 0px 10px">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">
                            <i class="fas fa-plus-circle"></i>
                            新增廠商
                        </button>
                    </li>
                    <li class="nav-item" style="flex-grow: 1">
                        <form class="form-inline my-2 my-lg-0">
                            <input class="search form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- 每個人填資料的區塊 -->
            <div style="margin-top: 1rem">
                <table class="table table-striped table-bordered" style="text-align: center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">姓名</th>
                            <th scope="col">電子郵箱</th>
                            <th scope="col">手機</th>
                            <th scope="col">生日</th>
                            <th scope="col">地址</th>
                            <th scope="col">修改</th>
                            <th scope="col">刪除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>王小明</td>
                            <td>hihi@gmail.com</td>
                            <td>0988555888</td>
                            <td>2000-05-09</td>
                            <td>台北市大安區資訊教育研究所</td>
                            <td><a href="#"><i class="fas fa-edit"></i></a></td>
                            <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>王小明</td>
                            <td>hihi@gmail.com</td>
                            <td>0988555888</td>
                            <td>2000-05-09</td>
                            <td>台北市大安區資訊教育研究所</td>
                            <td><a href="#"><i class="fas fa-edit"></i></a></td>
                            <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>王小明</td>
                            <td>hihi@gmail.com</td>
                            <td>0988555888</td>
                            <td>2000-05-09</td>
                            <td>台北市大安區資訊教育研究所</td>
                            <td><a href="#"><i class="fas fa-edit"></i></a></td>
                            <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>王小明</td>
                            <td>hihi@gmail.com</td>
                            <td>0988555888</td>
                            <td>2000-05-09</td>
                            <td>台北市大安區資訊教育研究所</td>
                            <td><a href="#"><i class="fas fa-edit"></i></a></td>
                            <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 我是分頁按鈕列 請自取並調整頁面擺放位置 -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link my_text_blacktea" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>


            <!-- 刪除提示框 -->
            <!-- <div class="delete update card">
                    <div class="delete card-body">
                        <label class="delete_text">您確認要刪除資料嗎?</label>
                        <div>
                            <button type="button" class="delete btn btn-danger">確認</button>
                            <button type="button" class="delete btn btn-warning">取消</button>
                        </div>
                    </div>
                </div> -->

    </section>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>