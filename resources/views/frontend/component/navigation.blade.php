<style>
    .navigation .dropdown-menu li:hover a{
        background: blue !important;
        color:#fff;
    }
    /*xóa đi sẽ xuất hiện lại */
    .hidden-menu-item {
        display: none !important;
    }
</style>

<script>
//xóa đi thì sẽ xuất hiện lại
document.addEventListener('DOMContentLoaded', function() {
    // Ẩn các menu items "Flash sale", "Liên hệ", "Bài viết"
    const menuItems = document.querySelectorAll('.navigation .main-menu li a');
    
    menuItems.forEach(function(item) {
        const text = item.textContent.trim();
        if (text === 'Flash sale' || text === 'Liên hệ' || text === 'Bài viết') {
            item.closest('li').classList.add('hidden-menu-item');
        }
    });
});
</script>

<div class="navigation">
    <ul class="uk-list uk-clearfix uk-navbar-nav main-menu">
        {!! $menu['main-menu'] ?? '' !!}
    </ul>
</div>