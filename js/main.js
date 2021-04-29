var x = document.querySelector(".add #ncateg input");
if (x != null) {
  x.addEventListener("input", function () {
    var y = document.querySelector(".add select");
    if (x.value == "") {
      y.disabled = false;
    } else {
      y.disabled = true;
    }
  });
}
var orderBtn = document.querySelector(".descrip button");
if(orderBtn != null){
  orderBtn.addEventListener("click", function(){
    orderBtn.setAttribute("style", "display:none");
    var orderDetail = document.querySelector(".order-details");
    orderDetail.setAttribute("style", "display:block");
  })
}