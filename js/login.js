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

inputs.forEach(input => {
    input.addEventListener("focus", addc1);
    input.addEventListener("blur", remc1);
});
