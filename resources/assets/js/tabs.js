(function($) {
    $(function() {
        console.log(document.cookie);

        $('ul.tabs__caption').on('click', 'li:not(.active)', function() {
            $(this)
                .addClass('active').siblings().removeClass('active')
                .closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
            console.log(document.cookie = this);
        });
    });
})(jQuery);