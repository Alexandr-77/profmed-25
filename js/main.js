// 
// ================================================== 
let burger = document.querySelector('.burger');
let nav = document.querySelector('.header__block-nav');
let liHeader = document.querySelectorAll('.header__menu-item');

burger.addEventListener('click', rotateBurger); 

for(let i = 0; i < liHeader.length; i++ ) {
  liHeader[i].addEventListener('click', rotateBurger);
}


function rotateBurger() { 
  burger.classList.toggle('burger-active');

  if (nav.style.display === "block" && screen.width <= 990) {
    nav.style.display = "none";
  } else {
    nav.style.display = "block";
  }
}

// ===========================================
// отправка формы =============>
$(document).ready(function() {

	//E-mail Ajax Send
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Спасибо. Ваша заявка была отправлена. Наш менеджер свяжется с вами в течение 24 часов.");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});

});
// ============================
// ===============================================

