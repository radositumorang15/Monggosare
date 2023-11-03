const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
  setTimeout(() => {
    sign_up_btn.classList.add("hide");
    sign_in_btn.classList.remove("hide");
  }, 1000)
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
  setTimeout(() => {
    sign_up_btn.classList.remove("hide");
    sign_in_btn.classList.add("hide");
  }, 1000)
});
