// Выпадающий список
jQuery.noConflict()
jQuery(($) => {
    $('.select').on('click', '.select__head', function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $(this).next().fadeOut();
        } else {
            $('.select__head').removeClass('open');
            $('.select__list').fadeOut();
            $(this).addClass('open');
            $(this).next().fadeIn();
        }
    });

    $('.select').on('click', '.select__item', function () {
        $('.select__head').removeClass('open');
        $(this).parent().fadeOut();
        $(this).parent().prev().text($(this).text());
        $(this).parent().prev().prev().val($(this).text());
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('.select').length) {
            $('.select__head').removeClass('open');
            $('.select__list').fadeOut();
        }
    });
});

// Выпадающий список завершен

// =====================================================

// скролл ленда

$(document).on("click", "nav a", function (e) {
    e.preventDefault();
    var id = $(this).attr('href');
    var top = $(id).offset().top; // получаем координаты блока
    $('body, html').animate({ scrollTop: top }, 800); // плавно переходим к блоку
});

// скролл ленда завершен

// ================================================================

// Корзина
jQuery.noConflict()
var cart = {};
$('document').ready(function () {
    loadGoods();
    checkCart();
    showCart();
});

function loadGoods() {
    $.getJSON('goods.json', function (data) {
        var out = '';
        for (var key in data) {
            out += '<div class="product-item">';
            out += '<p class="item__name">' + data[key]['name'] + '</p>';
            out += '<p class="product-description">' + data[key]['description'] + '</p>';
            out += '<p class="item__price">' + data[key]['price'] + '</p>';
            out += '<button class="btn-price" data-art="' + key + '" >Buy</button>';
            out += '</div>';
        }
        $('#goods').html(out);
        $('button.btn-price').on('click', addToCart);
    });
}

function addToCart() {
    // добавляем товар в корзину
    var articul = $(this).attr('data-art');
    if (cart[articul] != undefined) {
        cart[articul]++;
    }

    else {
        cart[articul] = 1;
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    // console.log(cart);
    showCart();
}

function checkCart() {
    // проверка наличия корзины в локалстор
    if (localStorage.getItem('cart') != null) {
        cart = JSON.parse(localStorage.getItem('cart'));
    }
}

function showCart() {
    // вывод содержимого корзины
    var out = '';
    for (var w in cart) {
        out += w + '---' + cart[w] + '<br>';
    }
    $('#cart').html(out);
}
