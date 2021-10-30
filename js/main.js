$(window).scroll(function(){
    if ($(this).scrollTop() > 100){
        $("#nav").addClass('fixed_nav')
    }else{
        $("#nav").removeClass('fixed_nav')
    }
})

let rf = getCookie("cart_items");

if (rf == ""){
    setCookie("cart_items", "empty", 7)
}

if (rf != "empty"){
    document.getElementById("myCart").innerHTML = getCookie("cart_items");
}




let gg = getCookie("cart_items");

var wordCount = gg.match(/(\w+)/g).length;
var total_count = wordCount - 10;
var tt = total_count / 72;
document.getElementById("count_product").innerHTML = parseInt(tt)




var total_price = 0;
var item = false;
var item2 = document.getElementById("myCart").innerHTML
function add_to_cart(el){
    let name = el.getAttribute("data-name");
    let price = el.getAttribute("data-price");
    let des = el.getAttribute("data-des");
    let img = el.getAttribute("data-img");
    let stock = el.getAttribute("data-stock");
    let id = el.getAttribute("data-id");

    if (!item && item2 == ""){
        document.getElementById("myCart").innerHTML +=  "<div id='total_head'><span style='font-weight:bold;color:#000;' >Total:</span><span style='font-weight:bold;color:#000;' id='total_price' ></span>$<br><br></div>";
        item = true;
    }


    let stock_total = "";
    if (stock > 0){
        stock_total = "In stock";
    }else{
        stock_total = "Out of stock";
    }
    document.getElementById("myCart").innerHTML += "<div data-count='^' style='margin-bottom: 20px' id='cart-"+ id +"' class='row' >"+
           "<div class='col-md-3' ><img width='100%' src='actions/"+ img +"' ></div>"+
           "<div class='col-md-3' >"+ name +"</div>"+
           "<div class='col-md-3' id='prc' >"+ price +"$</div>"+
           "<div class='col-md-3' ><button class='btn btn-danger' onclick='delete_cart(this)' data-id='"+id+"' data-price='"+price+"'  ><i class='fas fa-trash-alt'></i></button></div>"+
        "</div>"






        if(gg != "empty"){
            let noe_price = parseFloat(document.getElementById("total_price").innerText)
            noe_price += parseFloat(price);
            document.getElementById("total_price").innerText = noe_price;
            console.log("!=")
        }else{
          if(gg == "empty"){
              total_price += parseFloat(price);
              document.getElementById("total_price").innerText = total_price;

              console.log("==")
          }
        }



        let count_t = document.getElementById("count_product").innerHTML;
        let tt_count = parseInt(count_t) + 1;
        document.getElementById("count_product").innerHTML = tt_count
    setCookie("cart_items", document.getElementById("myCart").innerHTML, 7)

    animation_add_to_cart()

}



function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


function delete_cart(el){
    let id = el.getAttribute("data-id");
    let price = el.getAttribute("data-price");
    document.getElementById("cart-" + id).remove();


    let total = parseFloat(document.getElementById("total_price").innerText)
     total_price =  total - price
    document.getElementById("total_price").innerText = total_price;

    if (total_price < 1){
        document.getElementById("total_head").remove();
        item = false;
        setCookie("cart_items", "empty", 7)
    }

    let count_t = document.getElementById("count_product").innerHTML;
    let tt_count = parseInt(count_t) - 1;
    document.getElementById("count_product").innerHTML = tt_count

    setCookie("cart_items", document.getElementById("myCart").innerHTML, 7)

}


$(document).ready(function(){
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#row #col").filter(function() {
            $("#col2").toggle($(this).text().toLowerCase().indexOf(value) > -1)

        });
    });
});


function animation_add_to_cart(){
  let div =  document.getElementById("alert_div");

  div.style.width = "240px";
  div.style.padding = "10px 0 10px 5px";

    setTimeout(function(){
        div.style.width = "0";
        div.style.padding = "0 0 0 0";
    },2500)

}