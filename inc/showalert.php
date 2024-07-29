<?php

// alerts here if function outside the class no need the keyword public
function showAlertSuccess($result){
echo "<script type='text/javascript' src='js/sweetalert2.all.min.js'></script>";
echo "<script type='text/javascript'>
document.addEventListener('DOMContentLoaded', ()=>{
Swal.fire({
position: 'top-end',
title: 'Notification',
text: '$result!',
icon: 'info',
allowOutsideClick: false,
showConfirmButton: false,
allowEscapeKey: false
});
setTimeout(()=>{
window.location.href = window.location.href;
},2000);
});
</script>";
}

// function showAlertNotification(){
// echo "<script type='text/javascript' src='js/sweetalert2.all.min.js'></script>";
// echo "<script type='text/javascript'>
// document.addEventListener('DOMContentLoaded', ()=>{
// Swal.fire({
// position: 'top-end',
// title: 'Notification',
// text: 'Login First for continuiation of shopping',
// icon: 'warning',
// allowOutsideClick: false,
// showConfirmButton: false,
// allowEscapeKey: false,
// footer: '<a id=".'swal-success'." type=".'button'." href=".'login'.">Confirm</a> &nbsp; <a id=".'swal-cancel'." type=".'button'." href=".'index'.">Cancel</a>'		
// });
// });
// </script>";
// }

function showAlertRegistrationSuccess(){
echo "<script type='text/javascript' src='js/sweetalert2.all.min.js'></script>";
echo "<script type='text/javascript'>
document.addEventListener('DOMContentLoaded', ()=>{
Swal.fire({
position: 'top-end',
title: 'Success',
text: 'Registration Successful!',
icon: 'success',
allowOutsideClick: false,
showConfirmButton: false,
allowEscapeKey: false
});
setTimeout(()=>{
window.location.href = 'index';
},2000);
});
</script>";
}

function showAlertDelete($result){
echo "<script type='text/javascript' src='js/sweetalert2.all.min.js'></script>";
echo "<script type='text/javascript'>
document.addEventListener('DOMContentLoaded', ()=>{
Swal.fire({
position: 'top-end',
title: 'Deleted',
text: '$result',
icon: 'error',
allowOutsideClick: false,
showConfirmButton: false,
allowEscapeKey: false,
});
setTimeout(()=>{
window.location.href = window.location.href;
},2000);
});
</script>";
}

function showAlertLoginError($result){ //<-- get the result variable in the statement of login
echo "<script type='text/javascript' src='js/sweetalert2.all.min.js'></script>";
echo "<script type='text/javascript'>
document.addEventListener('DOMContentLoaded', ()=>{
Swal.fire({
position: 'top-end',
title: 'Error',
text: '$result!',
icon: 'warning',
allowOutsideClick: false,
showConfirmButton: false,
allowEscapeKey: false,
timer: 1500
});
});
</script>";
}

function showAlertRegistrationError(){
echo "<script type='text/javascript' src='js/sweetalert2.all.min.js'></script>";
echo "<script type='text/javascript'>
document.addEventListener('DOMContentLoaded', ()=>{
Swal.fire({
position: 'top-end',
title: 'Error',
text: 'username or email is already exist!',
icon: 'warning',
allowOutsideClick: false,
showConfirmButton: false,
allowEscapeKey: false,
});
setTimeout(()=>{
window.location.href = window.location.href;
},2000);
});
</script>";
}

?>
