var compare = {
    name: function (a, b) {
        a = a.replace(/^the /i, '')
        b = b.replace(/^the /i, '')

        if (a > b) {
            return -1
        } else {
            return a > b ? 1 : 0
        }
    },
    number: function (a, b) {
        return a - b
    },
    date: function (a, b) {
        a = new Date(a)
        b = new Date(b)

        return a - b
    }
}

$('#sortable').each(function () {
    var $table = $(this)
    var $tbody = $table.find('tbody')
    var $controls = $table.find('th')
    var rows = $tbody.find('tr').toArray()

    $controls.on('click', function () {
        var $header = $(this)
        var order = $header.data('sort')
        var column

        //如果所點擊的資料項目已有ascending或descending的屬性值，則以相反的方式顯示內容
        if ($header.is('.ascending') || $header.is('.descending')) {
            $header.toggleClass('ascending descending')
            $tbody.append(rows.reverse())
        } else {
            $header.addClass('ascending')
            //自其他所有的標題移除ascending和descending類別屬性值
            $header.siblings().removeClass('ascending descending')
            // console.log(compare.hasOwnProperty(order));
            if (compare.hasOwnProperty(order)) {  //若compare物件具備方法
                column = $controls.index(this)   //取得資料行的索引編號

                rows.sort(function (a, b) {
                    a = $(a).find('td').eq(column).text()
                    b = $(b).find('td').eq(column).text()
                    return compare[order](a, b)
                })

                $tbody.append(rows)
            }
        }
    })
})


// var prices = [1,2,125,2,19,14]
// prices.sort(function(a,b){
//     //小到大
//     return a-b
//     //大到小
//     // return b-a
// })
// console.log(prices);