$(document).on("keydown", function(e){
	if ((e.ctrlKey || e.metaKey) && e.keyCode === 80) {
		 Swal.fire({
  	icon: "error",
  	title: "oops",
  	text: "Bawal gumamit ng ctr+p shortcut sa pag print",
    allowOutsideClick: false,
    allowEscapeKey: false,
    showConfirmButton: false,
    position: "bottom-start"
  });
  setTimeout(()=>{
    window.location.href = window.location.href;
  },1500);

		 e.stopPropagation(); // modern browser

  	e.preventDefault();

  	e.stopImmediatePropagation();
	}
});