const pswrdField = document.querySelector(".form input[type='password']"),
toggleIcon = document.querySelector(".form .field i");

toggleIcon.onclick = () =>{
  // if click eye
  if(pswrdField.type === "password"){
    // appear text
    pswrdField.type = "text";
    toggleIcon.classList.add("active");
  }else{
    // password
    pswrdField.type = "password";
    toggleIcon.classList.remove("active");
  }
}
