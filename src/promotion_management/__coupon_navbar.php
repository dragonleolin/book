<style>
    .page_nav ul{
        flex-grow: 1;
        justify-content: space-between;
    }
    .page_nav li{
        flex-grow:1;
        text-align: center;
    }
    .page_nav li.active {
        background-color: orange;
    }
</style>


<nav class="page_nav navbar navbar-expand-md navbar-light bg-light mb-3">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= $page_name == 'coupon_list' ? 'active' : '' ?>">
                <a class="nav-link" href="coupon_list.php">折價券列表</a>
            </li>
            <li class="nav-item <?= $page_name == 'coupon_insert' ? 'active' : '' ?>">
                <a class="nav-link" href="coupon_insert.php">新增折價券</a>
            </li>
            <li class="nav-item <?= $page_name == 'data_insert' ? 'active' : '' ?>">
                <a class="nav-link" href="coupon_member.php">規則列表</a>
            </li>

        </ul>
    </div>
</nav>