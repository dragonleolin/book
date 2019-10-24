<!DOCTYPE html>
<html>

<head>
    <title>Webslesson Tutorial | Search HTML Table Data by using JQuery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: 'textarea'
    });
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <style>
    #result {
        position: absolute;
        width: 100%;
        max-width: 870px;
        cursor: pointer;
        overflow-y: auto;
        max-height: 400px;
        box-sizing: border-box;
        z-index: 1001;
    }

    .link-class:hover {
        background-color: #f1f1f1;
    }
    </style>
</head>

<body>
    <br /><br />
    <form name="BR_form" id="br_insert" class="row" method="post" onsubmit="return book()">
        <div class="container" style="width:900px;">
            <h2 align="center">書評新增系統</h2>
            <br /><br />
            <div align="center">
                <input type="text" placeholder="書評標題" class="form-control" id="BR_title" name="BR_title">
            </div>
            <div align="center">
                <input type="text" id="BR_book_name" name="BR_book_name" placeholder="查詢書本名稱" class="form-control">
            </div>
            <ul class="list-group" id="result">
            </ul>
            <br />
            <div class="">
                <!-- <input type="text" id="BR_data" name="BR_data"> -->
            <textarea id="BR_data" name="BR_data"></textarea>
            </div>
        </div>
        <div  style="transform: translate(70vw,10vh)">
            <button type="submit" class="btn btn-warning" >
                &nbsp;確&nbsp;認&nbsp;新&nbsp;增&nbsp;
            </button>
        </div>
    </form>
</body>

<script>
//啟動搜尋
$('#BR_book_name').keyup(function() {
    search()
})

//顯示搜尋結果
function search_data(data) {
    var result = document.querySelector('#result')
    var html = '';
    for (var i = 0; i < data.length; i++) {
        html += '<li class="list-group-item link-class">' + '<span class="text-muted">' + data[i].name + '</span>' +
            '</li>';
    }
    result.innerHTML = html;

    $(document).ready(function() {
        $('#result li').click(function() {
            let book_name = $(this).text()
            $('#BR_book_name').val(book_name)
        })
    })

    $('body').click(function() {
        $('#result li').hide()
    })

}

//搜尋書本
var searchItem = document.querySelector('#BR_book_name'); //取ID
function search() {
    //取得搜尋字串
    if ($('#BR_book_name').val() != '') {
        $.ajax({
                method: "POST",
                url: "./BR_search_book_api.php", //進api
                data: {
                    search: searchItem.value
                }
            })
            .done(function(msg) {
                var data = JSON.parse(msg);
                search_data(data);
            });
    } else {
        $('#result li').hide()
    }
}

//傳送資料
    function book(){
        $('#' + 'BR_data').html( tinymce.get('BR_data').getContent() );
        $.ajax({
        url: 'BR_bookreview_insertAPI.php',
        method: 'POST',
        data: $('#br_insert').serialize(),
        success: function(data) {
            console.log(data)
        }
    })
    }
    

//     $('#bk_insert').on('click', function() {
//     let br_title = $('#BR_title').val()
//     let br_book_name = $('#BR_book_name').val()
//     let br_data = $('#BR_data').val()

//     $.ajax({
//         url: 'BR_bookreview_insertAPI.php',
//         method: 'POST',
//         data: {
//             BR_title:br_title,
//             BR_book_name:br_book_name,
//             BR_data:br_data
//         },
//         success: function(data) {
//             console.log(data)
//         }
//     })

// })
</script>

</html>