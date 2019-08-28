<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>
<!-- 右邊section資料欄位 -->

<section>
    <div class="container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>新增會員書籍</h4>
                <div class="title_line"></div>
            </div>
        </nav>

        <form style="margin-top: 10px;">
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter isbn">
                <small id="isbnHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="name">書名</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="書名">
            </div>
            <div class="form-group">
                <label for="categories">分類</label>
                <input type="text" class="form-control" id="categories" name="categories" placeholder="Enter isbn">
                <small id="categoriesHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="author">作者</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="作者名">
                <small id="authorHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="publishing">出版日期</label>
                <input type="text" class="form-control" id="publishing" name="publishing">
                <small id="publishingHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="fixed_price">定價</label>
                <input type="text" class="form-control" id="fixed_price" name="fixed_price" placeholder="Enter isbn">
                <small id="fixed_priceHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="page">定價</label>
                <input type="text" class="form-control" id="page" name="page">
                <small id="pageHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="savingStatus">書況</label>
                <input type="text" class="form-control" id="savingStatus" name="savingStatus" placeholder="書籍狀況">
                <small id="savingStatusHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
           
            
            
            <div style="text-align: center">
                <button type="submit" class="btn btn-warning" id="submit_btn">&nbsp;確&nbsp;認&nbsp;修&nbsp;改&nbsp;</button>
            </div>
        </form>


        <!-- 以下為修改或新增成功才會跳出來的顯示框 -->
        <!-- <div class="success update card">
                        <div class="success card-body">
                            <label class="success_text">修改成功</label>
                            <div><img class="success_img" src="../images/icon_checked.svg"></div>
                        </div>
                    </div> -->
    </div>
</section>
</div>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>