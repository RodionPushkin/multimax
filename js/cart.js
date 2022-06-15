jQuery.noConflict()
var cart = {}; //массив пустой корзины


$.getJSON('goods.json', function (data) {
   var goods = data;
   // console.log(goods);
   checkCart();
   // console.log(cart);
   showCart();

   function showCart() {
      var out = '';
      for (var key in cart) {
         out += goods[key].name;
         out += goods[key].price;
         out += '<button class="minus">-</button>';
         out += cart[key];
         out += '<button class="plus">+</button>';
         out += cart[key] * goods[key].price;
         out += '<button class="delete">x</button>';
         out += '<br>'
      }
      $('#my-cart').html(out);
   }

});

function checkCart() {
   // проверка наличия корзины в локалстор
   if (localStorage.getItem('cart') != null) {
      cart = JSON.parse(localStorage.getItem('cart'));
   }
}