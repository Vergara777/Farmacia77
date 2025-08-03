const inputs = document.querySelectorAll(".input");

function addc1() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}
function remc1() {
    let parent = this.parentNode.parentNode;
    if(this.value === ""){
        parent.classList.remove("focus");
    }
}
// mensaje de error si pone contraseña incorrecta
function error() {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Contraseña incorrecta',
        confirmButtonColor: '#28a745',
        timer: 1500
    });
}



inputs.forEach(input => {
    input.addEventListener("focus", addc1);
    input.addEventListener("blur", remc1);
});
