~(function ($) {

    function checkImage(urlToFile)
    {
        var xhr = new XMLHttpRequest();
        xhr.open('HEAD', urlToFile, false);
        xhr.send();

        if (xhr.status != "404") {
            return true;
        }
    }

    function changeImages()
    {
        $('.acf-tooltip ul li a').hover(function () {
            var imageLayoutSlug = $(this).attr('data-layout')

            var imageSource = adminLocal.img_path + imageLayoutSlug + '.png';
            var placeholder = adminLocal.placeholder;

            var link = (checkImage(imageSource)) ? imageSource : placeholder;

            $('.acf-tooltip').append('<div class="module-preview"><img src="'+link+'"></div>')
        }, function () {
            $('.module-preview').remove()
        })
    }

    function checkDOMChange()
    {
        let toolTips = document.querySelectorAll('.acf-tooltip ul li')
        if (toolTips.length) {
            changeImages(toolTips);
        } else {
            setTimeout(checkDOMChange, 100);
        }
    }

    function init()
    {
        $(document).on('click', 'a[data-name=add-layout]', function () {
            checkDOMChange()
        });
    }

    $(document).ready(init)

})(jQuery)